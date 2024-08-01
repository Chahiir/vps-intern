<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
            'note' => 'required|array',
        'note.*' => 'required|integer|min:1|max:5',
        'remarque' => 'nullable|array',
        'remarque.*' => 'nullable|string|max:255',
        'note_sub_categorie_id' => 'required|array',
        'note_sub_categorie_id.*' => 'required|integer|exists:note_sub_categories,id',
        'salarie_id' => 'required | integer',
        'point_fort'=> 'nullable | string | max:255',
        'point_ameliorer' => 'nullable | string | max:255',
        'action' => 'nullable | string | max:255',
        'projet' => 'nullable | string | max:255',
        'commentaire' => 'nullable | string | max:255',
        'note_final' => 'required'
        ];
    }
}
