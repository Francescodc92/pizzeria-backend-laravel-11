<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class MakePaymentRequest extends FormRequest
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
    public function rules()
    {
        return [
            'token' => 'required|string',
            'userAddress' => 'required|array',
            'userAddress.road' => 'required|string|max:255',
            'userAddress.city' => 'required|string|max:255',
            'userAddress.country' => 'required|string|max:255',
            'userAddress.zip_code' => 'required|string|max:10',
            'pizzas' => 'required|array|min:1',
            'pizzas.*.pizza' => 'required|exists:pizzas,id',
            'pizzas.*.quantity' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'token.required' => 'Il token è obbligatorio.',
            'userAddress.required' => 'L\'indirizzo dell\'utente è obbligatorio.',
            'userAddress.road.required' => 'La strada è obbligatoria.',
            'userAddress.city.required' => 'La città è obbligatoria.',
            'userAddress.country.required' => 'Il paese è obbligatorio.',
            'userAddress.zip_code.required' => 'Il codice postale è obbligatorio.',
            'pizzas.required' => 'Devi aggiungere almeno una pizza.',
            'pizzas.*.pizza.required' => 'L\'ID della pizza è obbligatorio.',
            'pizzas.*.pizza.exists' => 'La pizza selezionata non esiste.',
            'pizzas.*.quantity.required' => 'La quantità è obbligatoria.',
            'pizzas.*.quantity.integer' => 'La quantità deve essere un numero intero.',
            'pizzas.*.quantity.min' => 'La quantità deve essere almeno 1.'
        ];
    }
}
