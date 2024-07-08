<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartenaireRequest extends FormRequest
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
            'nom' => 'string|max:255|required' ,
            'prenom' => 'string|max:255|required' ,
            'cin' => 'required|string|regex:/^[A-Za-z]{1,2}[0-9]+$/' ,
            'entreprise' => 'string|max:255|required'
        ];
    }

    public function messages(){
      return [
          'nom.required' => 'Le nom et prénom sont obligatoire.',
          'prenom.required' => 'Le nom et prénom est obligatoire.',
          'cin.required' => 'Le CIN est obligatoire.',
          'cin.regex' => 'Le CIN doit commencer par une ou deux lettres suivies de chiffres.',
          'entreprise.required' => 'L\'entreprise est requise.',
      ];
    }
}
