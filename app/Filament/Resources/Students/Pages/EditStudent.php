<?php

namespace App\Filament\Resources\Students\Pages;

use App\Filament\Resources\Students\StudentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class EditStudent extends EditRecord
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $userData = Arr::only($data, ['name', 'email', 'password']);
        $studentData = Arr::except($data, ['name', 'email', 'password']);

        $record->user->update(Arr::except($userData, ['password']));

        if (!empty($userData['password'])) {
            $record->user->update(['password' => Hash::make($userData['password'])]);
        }

        $record->update($studentData);
        return $record;
    }
}
