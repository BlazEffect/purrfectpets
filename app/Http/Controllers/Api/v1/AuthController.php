<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    /**
     * Register api
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'FIO' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Ошибки валидации.', $validator->errors()->toArray());
        }

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $fio = explode(' ', $input['FIO']);
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

        return $this->sendError('Неверные данные', ['error' => 'Не авторизован']);
    }

    public function logout(): JsonResponse
    {
        Auth()->user()->tokens()->delete();

        return $this->sendResponse([], 'Пользователь успешно вышел.');
    }
}
