<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     *                     @OA\Property(property="confirm_password", type="string", example="morozov123"),
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
     *     )
     * )
     *
     * @param Request $request
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function updateUserProfile(Request $request): ApiSuccessResponse|ApiErrorResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'string|max:100',
            'surname' => 'string|max:100',
            'email' => 'unique:users|email',
            'confirm_password' => 'same:password',
        ]);

        if ($validator->fails()) {
            return new ApiErrorResponse('Ошибки валидации.', $validator->errors()->toArray());
        }

        $authUser = auth()->user();
        $user = User::find($authUser->id);

        $updateUser = $request->only(['email', 'password']);
        $updateUserProfile = $request->only(['first_name', 'surname', 'last_name', 'phone']);

        if (!empty($updateUser)) {
            $user->update($updateUser);
        }
        if (!empty($updateUserProfile)) {
            $user->profile()->update($updateUserProfile);
        }

        return new ApiSuccessResponse($user->load('profile'), 'Профиль успешно обновлен');
    }
}
