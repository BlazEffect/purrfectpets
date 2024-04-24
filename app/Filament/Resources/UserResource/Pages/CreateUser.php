<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $userProfile = [
            'first_name' => $data['first_name'],
            'surname' => $data['surname'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
        ];

        $user = $this->getModel()::create($data);

        $user->profile()->create($userProfile);

        return $user;
    }
}
