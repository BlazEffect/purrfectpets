<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class FeedbackFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'FIO' => ['required'],
            'email' => ['required', 'email'],
            'message' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'FIO.required' => 'ФИО является обязательным полем',
            'email.required' => 'Email является обязательным полем',
            'email.email' => 'Вы ввели некорректный email',
            'message.required' => 'Обращение является обязательным полем',
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
}
