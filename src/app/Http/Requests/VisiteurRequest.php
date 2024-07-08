<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisiteurRequest extends FormRequest
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
        'entreprise' => 'required|string|max:255',
        'badge_id' => 'required|numeric',
        'entrer' => 'date',
        'sortie' => 'date',
        'motif' => 'string|max:255',
      ];
    }
    public function messages(){
      return [
          'nom.required' => 'Le nom et prénom sont obligatoire.',
          'prenom.required' => 'Le nom et prénom est obligatoire.',
          'cin.required' => 'Le CIN est obligatoire.',
          'cin.regex' => 'Le CIN doit commencer par une ou deux lettres suivies de chiffres.',
          'entreprise.required' => 'L\'entreprise est requise.',
          'badge_id.required' => 'Le badge affecter est obligatoire.',
          'badge_id.regex' => 'Le badge affecter est obligatoire',
          'entrer.required' => 'L\'heure d\'entrer est obligatoire.',
          'motif.required' => 'Le motif de visite est requis.',
          'motif.regex' => 'Le motif de visite est requis.',
      ];
    }
}
