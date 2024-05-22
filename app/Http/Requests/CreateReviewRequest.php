<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class CreateReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'text' => ['required'],
            'rating_value' => ['required', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Отзыв является обязательным полем',
            'text.required' => 'Текст отзыв является обязательным полем',
            'rating_value.required' => 'Оценка является обязательным полем',
            'rating_value.numeric' => 'Оценка должна быть числом',
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
