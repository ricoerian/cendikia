<?php

namespace App\Filament\Resources\ParentModels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ParentModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state)),

                TextInput::make('nik')->label('NIK')->unique(ignoreRecord: true)->nullable(),
                TextInput::make('phone_number')->label('No. Telepon')->tel(),
                TextInput::make('occupation')->label('Pekerjaan'),
                Textarea::make('address')->label('Alamat'),
                FileUpload::make('photo')->label('Foto Profil')->image()->directory('parent-photos'),
            ]);
    }
}
