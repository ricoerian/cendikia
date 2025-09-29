<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user.name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                TextInput::make('user.email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('user.password')
                    ->password()
                    ->revealable()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state))
                    ->maxLength(255),
                Select::make('status')->options([
                    'calon' => 'Calon',
                    'aktif' => 'Aktif',
                    'lulus' => 'Lulus',
                    'dikeluarkan' => 'Dikeluarkan',
                ])->required(),

                TextInput::make('nis')->required()->unique(ignoreRecord: true),
                TextInput::make('nisn')->unique(ignoreRecord: true)->nullable(),
                TextInput::make('place_of_birth')->label('Tempat Lahir'),
                DatePicker::make('date_of_birth')->label('Tanggal Lahir'),
                Select::make('gender')->label('Jenis Kelamin')
                    ->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']),
                TextInput::make('religion')->label('Agama'),
                Textarea::make('address')->label('Alamat'),
                FileUpload::make('photo')->label('Foto Profil')->image()->directory('student-photos'),
            ]);
    }
}
