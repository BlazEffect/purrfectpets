<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = $this->getModel()::find($data['id']);
        $userProfile = $user->profile()->first();

        $data['first_name'] = $userProfile['first_name'];
        $data['surname'] = $userProfile['surname'];
        $data['last_name'] = $userProfile['last_name'];
        $data['phone'] = $userProfile['phone'];

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        $userProfile = [
            'first_name' => $data['first_name'],
            'surname' => $data['surname'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
        ];

        $record->profile()->update($userProfile);

        return $record;
    }
}
