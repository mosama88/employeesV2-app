<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Employee;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class VacationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
         'code_num'=>'nullable|string',
            'type' => 'required|string|in:satisfying,emergency,regular,Annual,mission',
            'start' => 'required|date',
            'to' => 'required|date|after_or_equal:start',
            // 'to' => 'required|date|after:start +1 day',
            'notes' => 'nullable|string|max:1000',
            'employee_id' => 'required|exists:employees,id',
            'file' => 'nullable|file|mimes:docx,doc,pdf,png,webp,jpg,jpeg',
            'status' => 'nullable',
            'int_ext' => 'nullable|string|in:internal,external',
            'department_id' => 'nullable|exists:departments,id',
            'acting_employee_id' => 'nullable|exists:employees,id',
        ];
    }

    protected function withValidator(Validator $validator)
    {
        $validator->sometimes('int_ext', 'required', function ($input) {
            return $input->type === 'mission';
        });

        $validator->sometimes('department_id', 'required', function ($input) {
            return $input->type === 'mission' && $input->int_ext === 'internal';
        });

        // $validator->sometimes('acting_employee_id', 'required', function ($input) {
        //     return $input->type !== 'mission';
        // });

    }


    public function messages(): array
    {
        return [
            'type.required'=>'نوع الأجازه مطلوب',
            'type.in'=>'يجب أختيار نوع الأجازه الموجود بالجدول',
            ########################################################
            'start.required'=>'حقل أبتداء الاجازه مطلوب',
            'start.date_format' => 'تاريخ أبتداء الاجازه لا يتطابق مع الصيغة m/d/Y.',
            ########################################################
            'to.required'=>'حقل أنتهاء الاجازه مطلوب',
            'to.date_format' => 'تاريخ أنتهاء الاجازه لا يتطابق مع الصيغة m/d/Y.',
            'to.after_or_equal'=>'يجب أن يكون تاريخًا بعد البدء أو يساويه.',
            ########################################################
            'notes.max'=>'برجاء كتابة الملاحظات أقل من 1000 كلمة.',
            ########################################################
            'employee_id.required' => 'برجاء أختيار الموظف.',
            'employee_id.exists' => 'الموظف المحدد غير موجود.',
            ########################################################
            // 'acting_employee_id.exists' => 'الموظف القائم بأعمالة المحدد غير موجود.',
            ########################################################
            'file.file'=>'يجب أن يكون حقل الصورة من نوع ملف.',
            'file.mimes'=>'يجب أن يكون حقل الملف  من النوع:، doc,docs,pdf,png,webp,jpg,jpeg.',
        ];
    }

    public function passes($attribute, $value)
    {
        // احصل على اسم الموظف المعتمد
        $actingEmployeeName = Employee::find($value)->name;

        // قم بفحص ما إذا كان اسم الموظف المعتمد مطابقًا لاسم الموظف الرئيسي
        return $actingEmployeeName != Employee::find(request()->input('employee_id'))->name;

    }
}
