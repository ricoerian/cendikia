<?php

namespace App\Filament\Resources\ParentModels\Pages;

use App\Filament\Resources\ParentModels\ParentModelResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateParentModel extends CreateRecord
{
    protected static string $resource = ParentModelResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['user']) && is_array($data['user'])) {
            $userData = $data['user'];
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'role' => 'parent',
            ]);
            $data['user_id'] = $user->id;
            unset($data['user']);
        }
        return $data;
    }
}
