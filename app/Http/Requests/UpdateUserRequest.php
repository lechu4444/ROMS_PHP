<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'password' => 'confirmed',
            'avatar' => 'mimes:jpeg,jpg,png'
        ];
    }
}
