<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartenaireVisiteRequest extends FormRequest
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
            'motif' =>'string | required | max:255' ,
            'entrer' =>'date' ,
            'sortie' =>'date' ,
            'badge_id' =>'required|numeric' ,
            'partenaire_id' =>'required | numeric'
          ];
    }

    public function messages(){
      return [
          'badge_id.required' => 'Le badge affecter est obligatoire.',
          'badge_id.regex' => 'Le badge affecter est obligatoire',
          'entrer.required' => 'L\'heure d\'entrer est obligatoire.',
          'motif.required' => 'Le motif de visite est requis.',
          'motif.regex' => 'Le motif de visite est requis.',
      ];
    }
}
