<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

class UserController extends BaseApiController
{
    public function __construct(
        private readonly UserService $userService
    ){}

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
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Не авторизирован",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Вы не авторизованы.")
     *         )
     *     )
     * )
     *
     * @return ApiSuccessResponse
     */
    public function getUserProfile(): ApiSuccessResponse
    {
        $userProfile = $this->userService->getUserProfile();

        return new ApiSuccessResponse($userProfile, '');
    }

    /**
     * @OA\Patch(
     *     path="/user/profile",
     *     tags={"User"},
     *     summary="Обновить информацию о пользователе",
     *     description="Обновить информацию о пользователе",
     *     security={
     *         { "Bearer":{} }
     *     },
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(
     *                     @OA\Property(property="first_name", type="string", example="Николай"),
     *                     @OA\Property(property="surname", type="string", example="Морозов"),
     *                     @OA\Property(property="last_name", type="string", example="Михайлович"),
     *                     @OA\Property(property="phone", type="string", example="+7(951)712-13-25"),
     *                     @OA\Property(property="email", type="string", example="morozov@test.com"),
     *                     @OA\Property(property="password", type="string", example="morozov123"),
     *                     @OA\Property(property="confirm_password", type="string", example="morozov123")
     *                 )
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/UserWithProfile"),
     *             @OA\Property(property="message", type="string", example="")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Не авторизирован",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Вы не авторизованы.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="data", type="object", example={}),
     *             @OA\Property(property="message", type="string", example="Ошибка валидации.")
     *         )
     *     )
     * )
     *
     * @param UpdateUserProfileRequest $request
     * @return ApiSuccessResponse
     */
    public function updateUserProfile(UpdateUserProfileRequest $request): ApiSuccessResponse
    {
        $request->validated();

        $updateUser = $request->only(['email', 'password']);
        $updateUserProfile = $request->only(['first_name', 'surname', 'last_name', 'phone']);

        $updatedUserProfile = $this->userService->updateUserProfile($updateUser, $updateUserProfile);

        return new ApiSuccessResponse($updatedUserProfile, 'Профиль успешно обновлен');
    }
}
