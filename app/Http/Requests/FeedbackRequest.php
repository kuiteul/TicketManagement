<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
            'notes' => 'required',
            'comments' => 'required|min:5|max:100',
            'user_id' => 'required',
            'ticket_id' => 'required',
            'ticket_manager_id' => 'required'
        ];
    }

    public function messages(): array 
    {
        return[
            'notes.required' => "Ce champ est requis",
            'comments.required' => 'Ce champ est requis',
            'comments.min' => 'Entrer au moins 05 caractères',
            'comments.max' => 'Ce champ doit contenir maximum 100 caractères',
            'user_id.required' => 'Le champ user_id n\' a pas été retrouvé ',
            'ticket_id.required' => 'Le champ ticket_id n\'a pas été retrouvé',
            'ticket_manager_id.required' => 'Le champ manager id n\'a pas été retrouvé'
        ];
    }
}
