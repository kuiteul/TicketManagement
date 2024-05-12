<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchedulingRequest extends FormRequest
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
            'ticket_manager_id' => 'required|min:36|max:36',
            'date_started' => 'required|date',
            'date_ended' => 'required|date',
            'scheduling_reason' => 'required'
        ];
    }

    public function messages(): array 
    {
        return [
            'ticket_manager_id.required' => "It's as though you try to bypass the security",
            'ticket_manager_id.min' => "It's as though you try to bypass the security",
            'ticket_manager_id.max' => "It's as though you try to bypass the security",
            'date_started.required' => "Vous devez spécifier une date de début",
            'date_started.date' => "La valeur attendu est de type date",
            'date_ended.required' => "Vous devez spécifier une date de début",
            'date_ended.date' => "La valeur attendu est de type date",
            'scheduling_reason' => "Vous devez renseigner la raison"

        ];
    }
}
