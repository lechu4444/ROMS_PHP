<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'birthday' => 'required|date|date_format:Y-m-d',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'avatar' => 'nullable|mimes:jpeg,jpg,png'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole imię jest wymagane',
            'surname.required' => 'Pole nazwisko jest wymagane',
            'birthday.required' => 'Pole data urodzenia jest wymagane',
            'birthday.date' => 'Pole data urodzenia nie jest prawidłową datą',
            'birthday.date_format' => 'Pole data urodzenia nie jest w formacie RRRR-MM-DD',
            'email.required' => 'Pole email jest wymagane',
            'email.email' => 'Format pola email nie jest prawidłowy',
            'email.unique' => 'Taki email już istnieje w bazie danych',
            'password.required' => 'Pole hasło jest wymagane',
            'password.confirmed' => 'Potwierdzenie dla pola hasło nie zgadza się',
            'avatar.mimes' => 'Pole avatar musi być plikiem typu jpeg, jpg, png',
        ];
    }
}
