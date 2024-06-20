<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:100',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required'=>'حقل الوظيفه مطلوب .',
            'name.min'=>'برجاء كتابة حقل الوظيفه أكثر من 5 كلمات.',
            'name.max'=>'برجاء كتابة حقل الوظيفه أقل من من 100 كلمة.',
        ];
    }
}
