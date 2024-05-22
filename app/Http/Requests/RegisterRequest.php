<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password'],
            'FIO' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email является обязательным полем',
            'email.unique' => 'Такой email уже существует',
            'email.email' => 'Вы ввели некорректный email',
            'password.required' => 'Пароль является обязательным полем',
            'confirm_password.required' => 'Вы не ввели подтверждение пароля',
            'confirm_password.same' => 'Пароли не совпадают',
            'FIO.required' => 'ФИО является обязательным полем',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = [
            'success' => false,
            'data' => $validator->errors()->toArray(),
            'message' => 'Ошибки валидации.',
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }
}
