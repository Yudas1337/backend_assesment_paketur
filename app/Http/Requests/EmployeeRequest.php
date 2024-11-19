<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class EmployeeRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:100', Rule::unique('users')->ignore($this->employee)],
            'name' => ['required', 'max:150'],
            'password' => ['required', 'min:8'],
            'phone_number' => ['required', 'max:50', Rule::unique('employee_details')->ignore($this->employee->id, 'user_id')],
            'address' => ['required'],
            'company_id' => [
                'required',
                Rule::exists('companies', 'id')->where(function ($query) {
                    $query->where('id', auth()->user()->employeeDetail->company_id);
                })
            ],
        ];
    }

    /**
     * Custom validation messages
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
            'password.required' => trans('validation.required', ['attribute' => 'Password']),
            'password.min' => trans('validation.min', ['attribute' => 'Password', 'min' => '8']),
            'phone_number.required' => trans('validation.required', ['attribute' => 'Nomor Telefon']),
            'phone_number.max' => trans('validation.max', ['attribute' => 'Nomor Telefon', 'max' => '50']),
            'phone_number.unique' => trans('validation.unique', ['attribute' => 'Nomor Telefon']),
            'address.required' => trans('validation.required', ['attribute' => 'address']),
            'company_id.required' => trans('validation.required', ['attribute' => 'Company']),
            'company_id.exists' => trans('validation.exists', ['attribute' => 'Company'])
        ];
    }
}
