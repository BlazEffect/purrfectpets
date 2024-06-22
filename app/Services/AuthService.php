<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @param array $input
     * @return User
     */
    public function registerUser(array $input): User
    {
        $input['password'] = bcrypt($input['password']);
        $input['active'] = true;
        return User::create($input);
    }

    /**
     * @param User $user
     * @param array $fio
     * @param string|null $phone
     * @return UserProfile
     */
    public function createUserProfile(User $user, array $fio, ?string $phone): UserProfile
    {
        $profileData = [
            'first_name' => $fio[1],
            'surname' => $fio[0],
            'last_name' => $fio[2],
            'phone' => $phone,
        ];
        return $user->profile()->create($profileData);
    }

    /**
     * @param string $email
     * @param string $password
     * @return User|null
     */
    public function attemptLogin(string $email, string $password): ?User
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return Auth::user();
        }

        return null;
    }

    /**
     * @return void
     */
    public function logoutUser(): void
    {
        Auth::user()->tokens()->delete();
    }
}
