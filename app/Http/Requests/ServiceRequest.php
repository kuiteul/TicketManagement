<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'department_id' => 'required',
            'service_name' => 'required|min:3|max:20',
            'service_location' => 'required|min:5|max:20',
            'email_service' => 'email|required'
        ];
    }

    public function messages(): array 
    {
        return [
            'department_id.required' => 'Vous devez sélectionner un département',
            'service_name.required' => 'Ce champ ne doit pas être vide',
            'service_name.min' => 'Ce champ doit comporter mininmum 03 caractères',
            'service_name.max' => 'Ce champ doit comporter au plus 20 caractères',
            'service_location.required' => 'Ce champ ne doit pas être vide',
            'service_location.min' => 'Ce champ doit comporter mininmum 03 caractères',
            'service_location.max' => 'Ce champ doit comporter au plus 20 caractères',
            'email.email' => "Vous devez entrer une adresse email valide",
            'email.required' => "L'adresse email est requis"
        ];
    }
}
