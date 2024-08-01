<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'salarier_id' => 'required | numeric',
            'email' => 'required|string',
            'password' => 'required | string|',
            'c_password' => 'required | same:password',
            'role_id' => 'required | numeric',
        ];
    }

    public function messages()
    {
        return [
            'salarier_id' => 'Le salarier est obligatoire.',
            'email' => 'l\'email est obligatoire.',
            'password' => 'le password est obligatoire.',
            'c_password' => 'la confirmation du password est obligatoire',
            'role_id' => 'le role est obligatoire.',
            'c_password.same' => 'les passwords doivent correspondre.',
        ];
    }
}
