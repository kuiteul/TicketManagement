<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
           'first_name' => 'required|min:3|max:20',
           'last_name' => 'required|min:3|max:20',
           'email' => 'required|email',
           'service_id' => 'required|min:36|max:36',
           'position' => 'required|min:3|max:30',
           'password' => 'required|min:8'
        ];
    }
}
