<?php

namespace App\Models;

use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasApiTokens, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    protected function userNameAndSurname(): Attribute
    {
        return Attribute::make(
            get: function () {
                $userProfile = $this->profile()->first();

                return $userProfile->first_name . ' ' . $userProfile->surname;
            }
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->active === 1 &&
            ($this->hasRole(Utils::getSuperAdminName()) || $this->hasRole(Utils::getPanelUserRoleName()));
    }

    public function getFilamentName(): string
    {
        return $this->user_name_and_surname;
    }
}
