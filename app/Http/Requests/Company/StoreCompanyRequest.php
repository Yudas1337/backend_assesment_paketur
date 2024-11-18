<?php

namespace App\Http\Requests\Company;

use App\Http\Requests\ApiRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class StoreCompanyRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:150', Rule::unique('companies')->ignore($this->company)],
            'email' => ['required', 'email', 'max:100', Rule::unique('companies')->ignore($this->company)],
            'phone_number' => ['required', 'string', 'max:15', Rule::unique('companies')->ignore($this->company)],
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
            'name.required' => trans('validation.required', ['attribute' => 'name']),
            'name.max' => trans('validation.max', ['attribute' => 'name', 'max' => '150']),
            'name.unique' => trans('validation.unique', ['attribute' => 'name']),
            'email.required' => trans('validation.required', ['attribute' => 'email']),
            'email.email' => trans('validation.email', ['attribute' => 'email']),
            'email.max' => trans('validation.max', ['attribute' => 'email', 'max' => '100']),
            'email.unique' => trans('validation.unique', ['attribute' => 'email']),
            'phone_number.required' => trans('validation.required', ['attribute' => 'phone_number']),
            'phone_number.max' => trans('validation.max', ['attribute' => 'phone_number', 'max' => '15']),
            'phone_number.unique' => trans('validation.unique', ['attribute' => 'phone_number']),
        ];
    }
}
