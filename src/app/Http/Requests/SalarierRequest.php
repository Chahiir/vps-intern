<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rule as ValidationRule;
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
            'cin' => 'required|string|regex:/^[A-Za-z]{1,2}[0-9]+$/|', ValidationRule::unique('salaries')->ignore($this->route('id')),
            'date_naissance' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->diffInYears(Carbon::now()) < 18) {
                        $fail('La personne doit avoir au moins 18 ans.');
                    }
                },
            ],
            'adresse' => 'required|string|max:255',
            'contrat_type' => 'required|numeric', // Assuming contrat_types is the table name
            'date_debut' => 'required|date|before_or_equal:today',
            'cnss' => 'nullable|string|max:255',
            'situation_familiale' => 'required|string|size:1',
            'date_exp_cin' => 'required|date|after:today',
            'n_assurer' => 'nullable',
            'date_exp_rma' => 'nullable|date|after:today',
            'fonction' => 'required',
            'service_id' => 'required | numeric | exists:services,id',
            'n_enfant_charge' => 'required',
            'phone' => 'required',
            'puk' => 'nullable|numeric',
            'sexe' => 'required',
            'categorie' => 'required',
            'nom_contact' => 'required|array',
            'nom_contact' => 'required|array',
            'nom_contact.*' => 'nullable|string|max:255',
            'phone_contact' => 'required|array',
            'phone_contact.*' => 'nullable|string|max:255',
            'lien_familiale' => 'required|array',
            'lien_familiale.*' => 'nullable|string|max:255',
            'manager_id' => 'nullable|numeric',
            'is_manager' => 'nullable',
            'documents.*' => 'nullable',
            'cimr' => 'nullable'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'cin.required' => 'Le CIN est obligatoire.',
            'cin.regex' => 'Le CIN doit commencer par une ou deux lettres suivies de chiffres.',
            'date_naissance.required' => 'La date de naissance est obligatoire.',
            'adresse.required' => 'L\'adresse est obligatoire.',
            'contrat_type.required' => 'Le type de contrat est obligatoire.',
            'date_debut.required' => 'La date de début de contrat est obligatoire.',
            'date_debut.before_or_equal' => 'La date de début de contrat doit être aujourd\'hui ou avant.',
            'cnss.max' => 'Le Code CNSS ne peut pas dépasser 255 caractères.',
            'situation_familiale.required' => 'La situation familiale est obligatoire.',
            'situation_familiale.size' => 'La situation familiale doit être de taille 1.',
            'date_exp_cin.required' => 'La date d\'expiration du CIN est obligatoire.',
            'date_exp_cin.after' => 'La CIN ne doit pas être expirer.',
            'n_assurer.required' => 'Le numéro d\'assurance est obligatoire.',
            'date_exp_rma.required' => 'La date d\'expiration de la RMA est obligatoire.',
            'date_exp_rma.after' => 'La RMA ne doit pas être expirer.',
            'fonction.required' => 'La fonction est obligatoire.',
            'service_id.required' => 'Le service est obligatoire.',
            'n_enfant_charge.required' => 'Le nombre d\'enfants à charge est obligatoire.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'puk.numeric' => 'Le PUK doit être un nombre.',
            'nature_depart.required' => 'La nature du départ est obligatoire.',
            'sexe.required' => 'Le sexe est obligatoire.',
            'categorie.required' => 'La catégorie est obligatoire.',
        ];
    }
}
