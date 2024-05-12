<?php

namespace App\Http\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'department_name' => 'required|max:55'
        ];
    }

    public function messages(): array 
    {
        return [
            'department_name.required' => "Ce champ est obligatoire",
            'department_name.max' => "Le nombre de caractères maximum est de 55"
        ];
    }
}
