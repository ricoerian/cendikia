<?php

namespace App\Filament\Exports;

use App\Models\Teacher;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class TeacherExporter extends Exporter
{
    protected static ?string $model = Teacher::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('user.name')
                ->label('Nama Guru'),
            ExportColumn::make('user.email')
                ->label('Email'),
            ExportColumn::make('employee_id')
                ->label('ID Pegawai'),
            ExportColumn::make('nip')
                ->label('NIP'),
            ExportColumn::make('position')
                ->label('Jabatan'),
            ExportColumn::make('gender')
                ->label('Jenis Kelamin'),
            ExportColumn::make('date_of_birth')
                ->label('Tanggal Lahir'),
            ExportColumn::make('address')
                ->label('Alamat'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your teacher export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
