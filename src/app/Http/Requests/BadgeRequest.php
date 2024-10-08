<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BadgeRequest extends FormRequest
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
            'reference' => 'string | max:255 | required',
            'taken' => 'string | nullable',
            'type_id' => 'integer|required'
        ];
    }

    public function messages(){
      return [
        'reference' => 'La reference du badge est obligatoire.',
        'type_id' => 'le type de badge est obligatoire'
      ];
    }
}
