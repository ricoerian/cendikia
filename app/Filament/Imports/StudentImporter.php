<?php

namespace App\Filament\Imports;

use App\Models\Student;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class StudentImporter extends Importer
{
    protected static ?string $model = Student::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('user.name')
                ->label('Nama Siswa'),
            ImportColumn::make('user.email')
                ->label('Email'),
            ImportColumn::make('nis')
                ->label('NIS'),
            ImportColumn::make('nisn')
                ->label('NISN'),
            ImportColumn::make('status')
                ->label('Status'),
            ImportColumn::make('gender')
                ->label('Jenis Kelamin'),
            ImportColumn::make('place_of_birth')
                ->label('Tempat Lahir'),
            ImportColumn::make('date_of_birth')
                ->label('Tanggal Lahir'),
            ImportColumn::make('religion')
                ->label('Agama'),
            ImportColumn::make('address')
                ->label('Alamat'),
        ];
    }

    public function resolveRecord(): Student
    {
        return Student::firstOrNew([
            'nis' => $this->data['nis'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your student import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
