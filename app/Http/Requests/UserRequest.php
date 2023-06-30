<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:4',
            'email' => 'required|email|string|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                'min:6'
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please fill your full name',
            'name.string' => 'Name must be characters',
            'name.min' => 'Name must be > :min.',
            'email.required' => 'Email must be fill...',
            'email.unique' => 'email already existed...',
            'email.email' => 'email invalid!',
            'password.required' => 'password can not be empty...',
            'password.min' => 'password at least 6 characters!'
        ];
    }
}
