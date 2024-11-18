<?php

namespace App\Http\Requests;

use App\Response\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    abstract public function rules(): array;

    /**
     * Return failed validation
     * @param Validator $validator
     * @return void
     */

    protected function failedValidation(Validator $validator): void
    {
        HttpResponse::error($validator->errors()->messages(), trans('alert.validation_errors'), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Return failed authorization
     *
     * @return void
     */

    protected function failedAuthorization(): void
    {
        HttpResponse::error(null, trans('alert.validation_errors'), Response::HTTP_UNAUTHORIZED);
    }
}
