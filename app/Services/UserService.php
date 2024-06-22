<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @return User|null
     */
    public function getUserProfile(): ?User
    {
        return Auth::user()?->load('profile');
    }

    /**
     * @param array $updateUser
     * @param array $updateUserProfile
     * @return User|null
     */
    public function updateUserProfile(array $updateUser, array $updateUserProfile): ?User
    {
        $authUser = Auth::user();
        $user = User::find($authUser?->id);

        if (!empty($updateUser)) {
            $user->update($updateUser);
        }
        if (!empty($updateUserProfile)) {
            $user->profile()->update($updateUserProfile);
        }

        return $user->load('profile');
    }
}
