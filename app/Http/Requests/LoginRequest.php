<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class LoginRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:255'],
        ];
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => trans('validation.required', ['attribute' => 'email']),
            'email.email' => trans('validation.email', ['attribute' => 'email']),
            'email.max' => trans('validation.max', ['attribute' => 'email', 'max' => '255']),
            'password.required' => trans('validation.required', ['attribute' => 'password']),
            'password.max' => trans('validation.max', ['attribute' => 'password', 'max' => '255']),
        ];
    }
}
