<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

class AuthController extends BaseApiController
{
    /**
     * Register api
     *
     * @OA\Post (
     *      path="/auth/register",
     *      tags={"Auth"},
     *      summary="Регистрация пользователя",
     *      description="Регистрация пользователя",
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              allOf={
     *                  @OA\Schema(
     *                      @OA\Property(
     *                          property="FIO",
     *                          type="string",
     *                          example="Морозов Николай Михайлович"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string",
     *                          example="morozov@test.com"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string",
     *                          example="morozov123"
     *                      ),
     *                      @OA\Property(
     *                          property="confirm_password",
     *                          type="string",
     *                          example="morozov123"
     *                      ),
     *                  )
     *              }
     *           )
     *       ),
     *       @OA\Response(
     *           response=200,
     *           description="Успешно",
     *           @OA\JsonContent(
     *               @OA\Property(property="success", type="boolean", example="true"),
     *               @OA\Property(property="data", type="object",
     *                  @OA\Property(property="access_token", type="string", example="randomtokenasfhaj398rureuuhfdshk")
     *               ),
     *               @OA\Property(property="message", type="string", example="Пользователь успешно зарегистрирован.")
     *           )
     *       ),
     *       @OA\Response(
     *           response=422,
     *           description="Ошибка валидации",
     *           @OA\JsonContent(
     *               @OA\Property(property="success", type="boolean", example="false"),
     *               @OA\Property(property="message", type="string", example="Ошибка валидации."),
     *               @OA\Property(property="data", type="object", example={})
     *           )
     *       )
     *  )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'FIO' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Ошибки валидации.', $validator->errors()->toArray());
        }

        $fio = explode(' ', $input['FIO']);

        if (count($fio) !== 3) {
            return $this->sendError('Ошибки валидации.', ['FIO' => 'Вы ввели некорректно ФИО.']);
        }

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $profileData = [
            'user_id' => $user->id,
            'first_name' => $fio[1],
            'surname' => $fio[0],
            'last_name' => $fio[2],
            'phone' => $input['phone'] ?? null,
        ];
        UserProfile::create($profileData);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse($success, 'Пользователь успешно зарегистрирован.');
    }

    /**
     * Login api
     *
     * @OA\Post (
     *     path="/auth/login",
     *     tags={"Auth"},
     *     summary="Авторизация пользователя",
     *     description="Авторизация пользователя",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             allOf={
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="email",
     *                         type="string",
     *                         example="morozov@test.com"
     *                     ),
     *                     @OA\Property(
     *                         property="password",
     *                         type="string",
     *                         example="morozov123"
     *                     )
     *                 )
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="token", type="string", example="randomtokenasfhaj398rureuuhfdshk")
     *             ),
     *             @OA\Property(property="message", type="string", example="Пользователь успешно вошел.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="message", type="string", example="Неверные данные."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="error", type="string", example="Не авторизован")
     *             )
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->post('email'), 'password' => $request->post('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('auth_token')->plainTextToken;

            return $this->sendResponse($success, 'Пользователь успешно вошел.');
        }

        return $this->sendError('Неверные данные.', ['error' => 'Не авторизован']);
    }

    /**
     * Logout Api
     *
     * @OA\Post(
     *     path="/auth/logout",
     *     tags={"Auth"},
     *     summary="Выход с аккаунта",
     *     description="Выход с аккаунта",
     *     security={
     *         { "Bearer":{} }
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="true"),
     *             @OA\Property(property="data", type="object", example={}),
     *             @OA\Property(property="message", type="string", example="Пользователь успешно вышел.")
     *         )
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth()->user()->tokens()->delete();

        return $this->sendResponse([], 'Пользователь успешно вышел.');
    }
}
