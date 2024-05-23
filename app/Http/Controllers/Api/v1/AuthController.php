<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\RegisterRequest;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Mail\RegisterAdminMail;
use App\Mail\RegisterUserMail;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

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

        if (count($fio) !== 3) {
            return new ApiErrorResponse(
                'Ошибки валидации.',
                ['FIO' => 'Вы ввели некорректно ФИО.'],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $password = $input['password'];

        $input['password'] = bcrypt($input['password']);
        $input['active'] = true;
        $user = User::create($input);

        $profileData = [
            'user_id' => $user->id,
            'first_name' => $fio[1],
            'surname' => $fio[0],
            'last_name' => $fio[2],
            'phone' => $input['phone'] ?? null,
        ];
        $userProfile = UserProfile::create($profileData);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;

        Mail::to($user->email)
            ->queue((new RegisterUserMail($user, $userProfile->toArray(), $password))
        );
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->queue((new RegisterAdminMail($user, $userProfile->toArray()))
        );

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
        if (Auth::attempt(['email' => $request->post('email'), 'password' => $request->post('password')])) {
            $user = Auth::user();
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
        Auth()->user()->tokens()->delete();

        return new ApiSuccessResponse([], 'Пользователь успешно вышел.');
    }
}
