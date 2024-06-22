<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\RegisterRequest;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Services\AuthService;
use App\Services\EmailService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends BaseApiController
{
    public function __construct(
        private readonly AuthService $userService,
        private readonly EmailService $emailService
    ){}

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
     *                      @OA\Property(property="FIO", type="string", example="Морозов Николай Михайлович"),
     *                      @OA\Property(property="email", type="string", example="morozov@test.com"),
     *                      @OA\Property(property="password", type="string", example="morozov123"),
     *                      @OA\Property(property="confirm_password", type="string", example="morozov123")
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
     *               @OA\Property(property="data", type="object", example={}),
     *               @OA\Property(property="message", type="string", example="Ошибка валидации.")
     *           )
     *       )
     *  )
     *
     * @param RegisterRequest $request
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function register(RegisterRequest $request): ApiSuccessResponse|ApiErrorResponse
    {
        $request->validated();

        $input = $request->all();
        $fio = explode(' ', $input['FIO']);

        if (count($fio) < 2 || count($fio) > 3) {
            return new ApiErrorResponse(
                'Ошибки валидации.',
                ['FIO' => 'Вы ввели некорректно ФИО.'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $user = $this->userService->registerUser($input);
        $userProfile = $this->userService->createUserProfile($user, $fio, $input['phone'] ?? null);
        $this->emailService->sendRegistrationEmails($user, $userProfile->toArray(), $input['password']);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;

        return new ApiSuccessResponse($success, 'Пользователь успешно зарегистрирован.');
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
     *                     @OA\Property(property="email", type="string", example="morozov@test.com"),
     *                     @OA\Property(property="password", type="string", example="morozov123")
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
     *         response=401,
     *         description="Неверные данные для авторизации",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example="false"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="error", type="string", example="Не авторизован")
     *             ),
     *             @OA\Property(property="message", type="string", example="Неверные данные.")
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function login(Request $request): ApiSuccessResponse|ApiErrorResponse
    {
        $user = $this->userService->attemptLogin($request->post('email'), $request->post('password'));

        if ($user) {
            $success['token'] = $user->createToken('auth_token')->plainTextToken;
            return new ApiSuccessResponse($success, 'Пользователь успешно вошел.');
        }

        return new ApiErrorResponse('Неверные данные.', ['error' => 'Не авторизован'], Response::HTTP_UNAUTHORIZED);
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
    public function logout(): ApiSuccessResponse
    {
        $this->userService->logoutUser();

        return new ApiSuccessResponse([], 'Пользователь успешно вышел.');
    }
}
