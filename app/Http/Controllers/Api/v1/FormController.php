<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackFormRequest;
use App\Http\Responses\ApiSuccessResponse;
use App\Mail\FeedbackFormMail;
use Illuminate\Support\Facades\Mail;
use OpenApi\Annotations as OA;

class FormController extends Controller
{
    /**
     * @OA\Post (
     *     path="/form/feedback",
     *     tags={"Form"},
     *     summary="Создание заказа",
     *     description="Создание заказа",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(
     *                     @OA\Property(property="FIO", type="string", example="Морозов Николай Михайлович"),
     *                     @OA\Property(property="email", type="string", example="morozov@test.com"),
     *                     @OA\Property(property="message", type="string", example="Комментарий")
     *                 )
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object", example={}),
     *             @OA\Property(property="message", type="string", example="Сообщение успешно отправлено.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="data", type="object", example={}),
     *             @OA\Property(property="message", type="string", example="Ошибки валидации.")
     *         )
     *     )
     * )
     *
     * @param FeedbackFormRequest $request
     * @return ApiSuccessResponse
     */
    public function feedback(FeedbackFormRequest $request): ApiSuccessResponse
    {
        $request->validated();

        $data = $request->all();

        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->queue((new FeedbackFormMail($data['FIO'], $data['email'], $data['message']))
        );

        return new ApiSuccessResponse('', 'Сообщение успешно отправлено.');
    }
}
