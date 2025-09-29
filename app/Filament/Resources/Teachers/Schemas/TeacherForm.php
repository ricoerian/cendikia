<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TeacherForm
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
                TextInput::make('employee_id')->label('ID Pegawai')->required(),
                TextInput::make('nip')->label('NIP')->nullable(),
                TextInput::make('position')->label('Jabatan')->required(),
                TextInput::make('phone_number')->label('No. Telepon')->tel(),
                Select::make('gender')->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),
                DatePicker::make('date_of_birth')->label('Tanggal Lahir'),
                Textarea::make('address')->label('Alamat'),
                FileUpload::make('photo')->label('Foto Profil')->image()->directory('teacher-photos'),
            ]);
    }
}
