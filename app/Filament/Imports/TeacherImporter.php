<?php

namespace App\Filament\Imports;

use App\Models\Teacher;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class TeacherImporter extends Importer
{
    protected static ?string $model = Teacher::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('user.name')
                ->label('Nama Guru'),
            ImportColumn::make('user.email')
                ->label('Email'),
            ImportColumn::make('employee_id')
                ->label('ID Pegawai'),
            ImportColumn::make('nip')
                ->label('NIP'),
            ImportColumn::make('position')
                ->label('Jabatan'),
            ImportColumn::make('gender')
                ->label('Jenis Kelamin'),
            ImportColumn::make('date_of_birth')
                ->label('Tanggal Lahir'),
            ImportColumn::make('address')
                ->label('Alamat'),
        ];
    }

    public function resolveRecord(): Teacher
    {
        return Teacher::firstOrNew([
            'employee_id' => $this->data['employee_id'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your teacher import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
