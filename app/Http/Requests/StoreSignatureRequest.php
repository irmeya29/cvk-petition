<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSignatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => strtolower(trim((string) $this->email)),
            'display_name' => $this->boolean('display_name'),
        ]);
    }

    public function rules(): array
    {
        return [
            'petition_id' => ['required', 'exists:petitions,id'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:190',
                Rule::unique('signatures', 'email')
                    ->where('petition_id', $this->input('petition_id')),
            ],
            'display_name' => ['nullable', 'boolean'],
            'accepted_terms' => ['accepted'],
            'accepted_data_policy' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Le prenom est obligatoire.',
            'last_name.required' => 'Le nom de famille est obligatoire.',
            'email.required' => "L'adresse e-mail est obligatoire.",
            'email.email' => 'Veuillez saisir une adresse e-mail valide.',
            'email.unique' => 'Cette adresse e-mail a deja signe la petition.',
            'accepted_terms.accepted' => "Vous devez accepter les conditions d'utilisation.",
            'accepted_data_policy.accepted' => "Vous devez accepter la politique d'utilisation des donnees.",
        ];
    }
}
