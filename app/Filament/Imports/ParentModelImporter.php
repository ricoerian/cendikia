<?php

namespace App\Filament\Imports;

use App\Models\ParentModel;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ParentModelImporter extends Importer
{
    protected static ?string $model = ParentModel::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('user.name')
                ->label('Nama Orang Tua'),
            ImportColumn::make('user.email')
                ->label('Email'),
            ImportColumn::make('nik')
                ->label('NIK'),
            ImportColumn::make('phone_number')
                ->label('No. Telepon'),
            ImportColumn::make('occupation')
                ->label('Pekerjaan'),
            ImportColumn::make('address')
                ->label('Alamat'),
        ];
    }

    public function resolveRecord(): ParentModel
    {
        return ParentModel::firstOrNew([
            'nik' => $this->data['nik'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your parent model import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
