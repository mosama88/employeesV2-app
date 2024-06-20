<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

//'name',
//'phone',
//'alter_phone',
//'hiring_date',
//'start_from',
//'job_grades_id',
//'address_id',
//'department_id',
//photo

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|min:6|max:100',
            'phone'=>'required|string|min:11|max:11',
            'alter_phone'=>'nullable|string|min:11|max:11',
            'hiring_date' => 'required|date',
            'start_from' => 'required|date',
            'birth_date' => 'required|date',
            'num_of_days' => 'nullable|integer|between:20,50',
            'add_service' => 'nullable|integer',
            'years_service' => 'nullable|integer',
            'job_grades_id'=> 'required|exists:job_grades,id',
            'notes' => 'nullable|string|max:1000',
            'address_id'=> 'required|exists:addresses,id',
            'department_id'=> 'required|exists:departments,id',
            'photo'=> 'image|mimes:png,jpg,jpeg,gif,webp',
        ];
    }



    public function messages(): array
    {
        return [
            'name.required'=>'أسم الموظف مطلوب',
            'name.min'=>'يجب ان يكون أسم الموظف أكثر من 6 أحرف',
            'name.max'=>'يجب ان يكون أسم الموظف أقل من 100 حرف',
            ########################################################
            'phone.required'=>'حقل الموبايل مطلوب',
            'phone.min'=>'يجب ان يكون حقل الموبايل 11 رقم',
            'phone.max'=>'يجب ان يكون حقل الموبايل 11 رقم',
            ########################################################
            'alter_phone.min'=>'يجب ان يكون حقل الموبايل 11 رقم',
            'alter_phone.max'=>'يجب ان يكون حقل الموبايل 11 رقم',
            ########################################################
            'hiring_date.required'=>'حقل تاريخ التعيين مطلوب',
            'hiring_date' => 'تاريخ التوظيف لا يتطابق مع الصيغة d/m/Y.',
            ########################################################
            'start_from.required'=>'حقل بداية أستلام العمل بالادارة مطلوب',
            'start_from.date' => 'تاريخ بداية أستلام العمل بالادارة لا يتطابق مع الصيغة d/m/Y.',
            ########################################################
            'birth_date.required'=>'حقل تاريخ الميلاد مطلوب',
            'birth_date.date' => 'تاريخ تاريخ الميلاد لا يتطابق مع الصيغة d/m/Y.',
            ########################################################
            'num_of_days.integar' => 'يجب أن يكون عدد الاجازات أرقام',
            'num_of_days.between' => 'يجب أن يكون عدد الاجازات بين 20 و 50',
            ########################################################
            'job_grades_id.required'=>'حقل الدرجه الوظيفية مطلوب ',
            'job_grades_id.exists' => 'الدرجه الوظيفية المحددة غير موجود.',
            ########################################################
            'address_id.required'=>'حقل المحافظة مطلوب',
            'address_id.exists' => 'المحافظة المحددة غير موجود.',
            ########################################################
            'department_id.required'=>'حقل النيابة التابع لها  مطلوب',
            'department_id.exists' => 'النيابة التابع لها المحدد غير موجود.',
            ########################################################
            'photo.image'=>'يجب أن يكون حقل الصورة من نوع صورة.',
            'photo.mimes'=>'يجب أن يكون حقل الصورة ملفًا من النوع:، gif png، jpg، jpeg، webp.',
            ########################################################
            'notes.max'=>'برجاء كتابة الملاحظات أقل من 1000 كلمة.',
        ];
    }
}
