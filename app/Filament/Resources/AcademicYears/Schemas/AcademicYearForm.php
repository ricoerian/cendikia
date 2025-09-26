<?php

namespace App\Filament\Resources\AcademicYears\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AcademicYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('year')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Example: 2025/2026'),

                Select::make('semester')
                    ->required()
                    ->options([
                        'Ganjil' => 'Ganjil',
                        'Genap' => 'Genap',
                    ]),

                DatePicker::make('start_date')
                    ->required(),

                DatePicker::make('end_date')
                    ->required()
                    ->after('start_date'),

                Toggle::make('status')
                    ->label('Aktif')
                    ->required(),
            ]);
    }
}
