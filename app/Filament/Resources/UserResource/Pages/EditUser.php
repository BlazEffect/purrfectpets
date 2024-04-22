<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
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
        $user = User::find($data['id']);

        $data['user_name_and_surname'] = $user->user_name_and_surname;

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        $nameAndSurname = explode(' ', $data['user_name_and_surname']);
        $record->profile()->update([
            'first_name' => $nameAndSurname[0],
            'surname' => $nameAndSurname[1],
        ]);

        return $record;
    }
}
