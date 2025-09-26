<?php

namespace App\Filament\Resources\Teachers\Pages;

use App\Filament\Resources\Teachers\TeacherResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class EditTeacher extends EditRecord
{
    protected static string $resource = TeacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    // Kita akan mengambil alih proses update data di sini
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $userData = Arr::only($data, ['name', 'email', 'password']);
        $teacherData = Arr::except($data, ['name', 'email', 'password']);

        $record->user->update(Arr::except($userData, ['password']));

        if (!empty($userData['password'])) {
            $record->user->update([
                'password' => Hash::make($userData['password'])
            ]);
        }

        $record->update($teacherData);

        return $record;
    }
}
