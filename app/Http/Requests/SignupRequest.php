<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'El campo password es obligatorio.',
            'password.min' => 'El password debe tener al menos :min caracteres.',
            'password.letters' => 'El password debe contener al menos una letra.',
            'password.mixedCase' => 'El password debe contener al menos una letra mayúscula y una letra minúscula.',
            'password.symbols' => 'El password debe contener al menos un símbolo (*^@_-+).',
            'password.numbers' => 'El password debe contener al menos un número.',
            'password.uncompromised' => 'El password proporcionado ha aparecido en una fuga de datos. Por favor, elija un password diferente.',
            'password.confirmed' => 'La confirmación de la password no coincide.',
            'password_confirmation.required' => 'El campo de confirmación de password es obligatorio.',


        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed',
                    Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->symbols()
                    ->numbers()
                    ->uncompromised()
            ]
        ];
    }
}
