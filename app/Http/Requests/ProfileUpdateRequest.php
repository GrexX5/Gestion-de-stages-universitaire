<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->user();
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
        ];

        // Règles spécifiques aux entreprises
        if ($user->isCompany()) {
            $rules = array_merge($rules, [
                'siret' => ['required', 'string', 'size:14', 'regex:/^\d{14}$/'],
                'description' => ['nullable', 'string', 'max:2000'],
                'naf_code' => ['nullable', 'string', 'max:10'],
                'legal_status' => ['nullable', 'string', 'max:100'],
                'website' => ['nullable', 'url', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'postal_code' => ['required', 'string', 'max:10'],
                'city' => ['required', 'string', 'max:100'],
                'country' => ['required', 'string', 'max:100'],
            ]);
        }

        return $rules;
    }
    
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'siret.required' => 'Le numéro SIRET est obligatoire.',
            'siret.size' => 'Le numéro SIRET doit comporter 14 chiffres.',
            'siret.regex' => 'Le numéro SIRET n\'est pas valide.',
            'description.max' => 'La description ne peut pas dépasser 2000 caractères.',
            'website.url' => 'L\'URL du site web n\'est pas valide.',
            'address.required' => 'L\'adresse est obligatoire.',
            'postal_code.required' => 'Le code postal est obligatoire.',
            'city.required' => 'La ville est obligatoire.',
            'country.required' => 'Le pays est obligatoire.',
        ];
    }
}
