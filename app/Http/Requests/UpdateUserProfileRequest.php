<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'max:100'],
            'surname' => ['string', 'max:100'],
            'email' => ['unique:users', 'email'],
            'confirm_password' => ['same:password'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.max' => 'Имя не может быть более 100 символов',
            'surname.max' => 'Фамилия не может быть более 100 символов',
            'email.unique' => 'Такой email уже существует',
            'email.email' => 'Вы ввели некорректный email',
            'confirm_password.same' => 'Пароли не совпадают',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = [
            'success' => false,
            'data' => $validator->errors()->toArray(),
            'message' => 'Ошибки валидации.',
        ];

        throw new HttpResponseException(response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    public function authorize(): bool
    {
        return true;
    }
}
