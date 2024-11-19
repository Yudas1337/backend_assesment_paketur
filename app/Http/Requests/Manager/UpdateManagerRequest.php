<?php

namespace App\Http\Requests\Manager;

use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class UpdateManagerRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:100', Rule::unique('users')->ignore(auth()->id())],
            'name' => ['required', 'max:150'],
            'password' => ['required', 'min:8'],
            'phone_number' => ['required', 'max:50', Rule::unique('employee_details')->ignore(auth()->id(), 'user_id')],
            'address' => ['required']
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
            'email.max' => trans('validation.max', ['attribute' => 'email', 'max' => '100']),
            'email.unique' => trans('validation.unique', ['attribute' => 'email']),
            'name.required' => trans('validation.required', ['attribute' => 'name']),
            'name.max' => trans('validation.max', ['attribute' => 'name', 'max' => '150']),
            'phone_number.required' => trans('validation.required', ['attribute' => 'Nomor Telefon']),
            'phone_number.max' => trans('validation.max', ['attribute' => 'Nomor Telefon', 'max' => '50']),
            'phone_number.unique' => trans('validation.unique', ['attribute' => 'Nomor Telefon']),
            'address.required' => trans('validation.required', ['attribute' => 'address']),
        ];
    }
}
