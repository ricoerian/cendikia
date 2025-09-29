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

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
        
        if (!$this->record->relationLoaded('user')) {
             $this->record->load('user');
        }

        $this->form->fill($this->record->toArray());
    }

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
        $userDataFromForm = Arr::get($data, 'user', []);
        $studentData = Arr::except($data, ['user']); 
        if (!empty($userDataFromForm)) {
            $userUpdateData = [
                'name' => Arr::get($userDataFromForm, 'name'),
                'email' => Arr::get($userDataFromForm, 'email'),
            ];
            if (!empty(Arr::get($userDataFromForm, 'password'))) {
                $userUpdateData['password'] = Hash::make($userDataFromForm['password']);
            }
            $record->user->update($userUpdateData);
        }
        $record->update($studentData);
        return $record;
    }
}
