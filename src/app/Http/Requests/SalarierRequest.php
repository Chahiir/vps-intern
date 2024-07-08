<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalarierRequest extends FormRequest
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
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'cin' => 'required|string|regex:/^[A-Za-z]{1,2}[0-9]+$/',
        'date_naissance' => 'required|date',
        'adresse' => 'required|string|max:255',
        'contrat_type' => 'required|numeric', // Assuming contrat_types is the table name
        'date_debut' => 'required|date',
        'cnss' => 'string|max:255',
        'situation_familiale' => 'required|string|size:1'
      ];
    }

    public function messages()
    {
      return [
          'nom.required' => 'Le nom et prénom sont obligatoire.',
          'prenom.required' => 'Le nom et prénom est obligatoire.',
          'cin.required' => 'Le CIN est obligatoire.',
          'cin.regex' => 'Le CIN doit commencer par une ou deux lettres suivies de chiffres.',
          'date_naissance.required' => 'La date de naissance est obligatoire.',
          'adresse.required' => 'L\'adresse est obligatoire.',
          'contrat_type.required' => 'Le type de contrat est obligatoire.',
          'date_debut.required' => 'La date de debut de contrat est obligatoire.',
          'cnss.required' => 'Le Code CNSS est obligatoire.',
          'situation_familiale.required' => 'La situation familiale est oblitgatoire.'
      ];
}
}
