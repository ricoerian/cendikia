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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'parent',
        ]);
        
        $data['user_id'] = $user->id;
        return $data;
    }
}
