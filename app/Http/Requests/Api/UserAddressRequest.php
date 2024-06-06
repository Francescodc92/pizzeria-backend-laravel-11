<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            "city" =>  ["required"],
            "country" =>  ["required"],
            "road" =>  ["required"],
            "zipCode" =>  ["required"]
        ];
    }

    public function messages(): array
    {
        return [
            "city.required" => "la città è obbligatoria",
            "country.required" => "la nazione è obbligatoria",
            "road.required" => "l'indirizzo è obbligatorio",
            "zipCode.required" => "il codice postale è obbligatorio",
        ];
    }
}
