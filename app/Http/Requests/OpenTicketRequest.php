<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenTicketRequest extends FormRequest
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
            'ticket_id' => "required|min:36|max:36",
            'user_id' => "required|min:36|max:36"
        ];
    }

    public function messages(): array 
    {
        return [
            'ticket_id.required' => "It seems like you have modified the HTML code to bypass the security",
            'ticket_id.min' => "It seems like you have modified the HTML code to bypass the security",
            'ticket_id.max' => "It seems like you have modified the HTML code to bypass the security",
            'user_id.required' => "It seems like you have modified the HTML code to bypass the security",
            'user_id.min' => "It seems like you have modified the HTML code to bypass the security",
            'user_id.max' => "It seems like you have modified the HTML code to bypass the security"
        ];
    }
}
