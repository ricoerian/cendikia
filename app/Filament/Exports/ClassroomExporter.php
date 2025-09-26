<?php

namespace App\Filament\Exports;

use App\Models\Classroom;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ClassroomExporter extends Exporter
{
    protected static ?string $model = Classroom::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
                ->label('Nama Rombel'),
            ExportColumn::make('academic_year_id')
                ->label('ID Tahun Ajaran'),
            ExportColumn::make('grade_id')
                ->label('ID Tingkat'),
            ExportColumn::make('major_id')
                ->label('ID Jurusan'),
            ExportColumn::make('teacher_id')
                ->label('ID Guru/Wali Kelas'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your classroom export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
