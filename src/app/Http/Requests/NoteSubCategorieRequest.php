<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteSubCategorieRequest extends FormRequest
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
            'name' =>'string | required ',
            'note_categorie_id' => 'required|numeric|exists:note_categories,id',
            'services' => 'required | array'
        ];
    }

    public function messages(){
      return [
        'name.required' => 'Le nom de la categorie est requis',
        'note_categorie_id.required' => 'L\'identifiant de la catégorie de note est obligatoire.',
        'note_categorie_id.numeric' => 'L\'identifiant de la catégorie de note doit être un nombre.',
        'note_categorie_id.exists' => 'La catégorie de note spécifiée n\'existe pas.',
        'services' => 'Les services inclus sont requise'
      ];
    }
}
