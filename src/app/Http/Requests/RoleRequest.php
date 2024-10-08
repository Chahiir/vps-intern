<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class RoleRequest extends FormRequest
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
            'name' => 'required|string|max:255|', ValidationRule::unique('roles')->ignore($this->route('id')),
            'permissions' => 'required | array'
        ];
    }

    public function messages(){
      return [
        'name' => 'le nom est obligatoire.',
        'name.unique' => 'le nom de role doit etre unique',
        'permissions' => 'les permissions sont requise'
      ];
    }
}
