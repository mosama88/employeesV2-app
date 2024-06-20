<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class HolidayRequest extends FormRequest
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
            'name' => 'required|string|min:10|max:300',
            'from' => 'required|date|date',
            'to' => 'required|date|date',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required'=>'حقل الأسم مطلوب.',
            'name.min'=>'برجاء كتابة حقل الأسم أكثر من 10 كلمات.',
            'name.max'=>'برجاء كتابة حقل الأسم أقل من من 300 كلمة.',
            ########################################################
            'from.required'=>'حقل أبتداء العطلة مطلوب',
            'from.date_format' => 'تاريخ أبتداء العطلة لا يتطابق مع الصيغة m/d/Y.',
            ########################################################
            'to.required'=>'حقل أنتهاء العطلة مطلوب',
            'to.date_format' => 'تاريخ بداية أنتهاء العطلة لا يتطابق مع الصيغة m/d/Y.',

        ];
    }
}
