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
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'avatar' => 'nullable|mimes:jpeg,jpg,png'
        ];
    }
}
