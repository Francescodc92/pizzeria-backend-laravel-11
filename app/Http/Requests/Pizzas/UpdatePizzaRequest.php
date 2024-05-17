<?php

namespace App\Http\Requests\Pizzas;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePizzaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'name' => 'required|max:255',
            'image'=> 'nullable|image|max:2048|mimes:jpg,bmp,png',
            'description' => 'required|max:1000',
            'price' => 'required|decimal:0,2',
            'discount_percent' => 'nullable|integer',
            'available' => 'nullable|boolean',
            'remove_image' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'il campo è obbligatorio',
            'name.max' => 'il testo non può contenere più di 255 caratteri',
            'image.mimes' => 'il file deve essere di tipo jpg, bmp o png',
            'description.max' => 'il testo non è più di 1000 caratteri',
            'description.required' => 'il campo è obbligatorio',
            'price.required' => 'il campo è obbligatorio',
            'discount_percent.integer' => 'il campo deve contenere solamente il numero della percentuale di sconto senza simboli'
        ];
    }
}
