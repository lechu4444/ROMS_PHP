<?php

namespace App\Http\Requests;

use App\User;
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
        $user = User::where('email', $this->email)->get()->first();
        $uniqueUsers = '';

        $id = (int) $this->route()->id;

        if ($user !== null && $user->id !== $id) {
            $uniqueUsers = '|unique:users';
        }

        return [
            'name' => 'required',
            'surname' => 'required',
            'birthday' => 'required|date|date_format:Y-m-d',
            'email' => 'required|email' . $uniqueUsers,
            'password' => 'confirmed',
            'avatar' => 'nullable|mimes:jpeg,jpg,png'
        ];
    }
}
