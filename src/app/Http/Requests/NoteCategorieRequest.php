<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteCategorieRequest extends FormRequest
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
            'name' => 'required | string',
        ];
    }

    public function messages(){
      return [
        'name.unique' => 'Le nom de la categorie doit etre unique',
        'name.required' => 'Le nom de la categorie est requis'
      ];
    }
}
