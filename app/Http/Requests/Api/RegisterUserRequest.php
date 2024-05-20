<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            "first_name" => ["required"],
            "last_name" => ["required"],
            "phone_number" => ["required"],
            "email" => ["required", "email", "unique:users"],
            "password" => ["required","confirmed"],
        ];
    }

    public function messages(): array
    {
        return [
            "first_name.required" => "Il nome è obbligatorio.",
            "last_name.required" => "Il cognome è obbligatorio.",
            "phone_number.required" => "Il numero di telefono è obbligatorio.",
            "email.required" => "L'email è obbligatoria.",
            "email.email" => "L'email deve essere un indirizzo email valido.",
            "email.unique" => "L'email è già in uso.",
            "password.required" => "La password è obbligatoria.",
            "password.confirmed" => "La conferma della password non corrisponde.",
        ];
    }
}
