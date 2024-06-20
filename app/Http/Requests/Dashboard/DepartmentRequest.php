<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

//'branch',
//'address_id',

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'branch'=>'required|string|min:6|max:100',
        ];
    }


    public function messages(): array
    {
        return [
            'branch.required'=>'أسم النيابة مطلوب',
            'branch.min'=>'يجب ان يكون أسم النيابة أكثر من 6 أحرف',
            'branch.max'=>'يجب ان يكون أسم النيابة أقل من 100 حرف',
        ];
    }
}
