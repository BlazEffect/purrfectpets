<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

class UserController extends BaseApiController
{
    /**
     * @OA\Get(
     *     path="/user/profile",
     *     tags={"User"},
     *     summary="Получить информацию о пользователе",
     *     description="Получить информацию о пользователе",
     *     security={
     *         { "Bearer":{} }
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/UserWithProfile"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     )
     * )
     *
     * @return ApiSuccessResponse
     */
    public function getUserProfile(): ApiSuccessResponse
    {
        $user = auth()->user();

        return new ApiSuccessResponse($user->load('profile'), '');
    }
}
