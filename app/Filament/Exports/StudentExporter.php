<?php

namespace App\Filament\Exports;

use App\Models\Student;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class StudentExporter extends Exporter
{
    protected static ?string $model = Student::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('user.name')
                ->label('Nama Siswa'),
            ExportColumn::make('user.email')
                ->label('Email'),
            ExportColumn::make('nis')
                ->label('NIS'),
            ExportColumn::make('nisn')
                ->label('NISN'),
            ExportColumn::make('status')
                ->label('Status'),
            ExportColumn::make('gender')
                ->label('Jenis Kelamin'),
            ExportColumn::make('place_of_birth')
                ->label('Tempat Lahir'),
            ExportColumn::make('date_of_birth')
                ->label('Tanggal Lahir'),
            ExportColumn::make('religion')
                ->label('Agama'),
            ExportColumn::make('address')
                ->label('Alamat'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your student export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
