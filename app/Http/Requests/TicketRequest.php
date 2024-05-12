<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'ticket_label' => 'required|min:5|max:20',
            'service_id' => 'required',
            'comments' => 'required|min:10|max:500'
        ];
    }

    public function messages(): array 
    {
        return [
            'ticket_label.required' => "Vous devez renseigner l'intitulé",
            "ticket_label.min" => "Veuillez renseigner 05 caractères minimum",
            "ticket_label.max" => "Vous avez dépassé les 20 caractères",
            "service_id.required" => "Vous devez sélectionner un service",
            "comments.required" => "Vous devez décrire le problème",
            "comments.min" => "La description doit contenir au moins 10 caractères",
            "comments.max" => "La description ne doit pas dépasser les 500 caractères"
        ];
    }
}
