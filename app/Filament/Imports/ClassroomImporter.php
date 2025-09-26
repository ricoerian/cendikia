<?php

namespace App\Filament\Imports;

use App\Models\Classroom;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class ClassroomImporter extends Importer
{
    protected static ?string $model = Classroom::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label('Nama Rombel'),
            ImportColumn::make('academic_year_id')
                ->label('ID Tahun Ajaran'),
            ImportColumn::make('grade_id')
                ->label('ID Tingkat'),
            ImportColumn::make('major_id')
                ->label('ID Jurusan'),
            ImportColumn::make('teacher_id')
                ->label('ID Guru/Wali Kelas'),
        ];
    }

    public function resolveRecord(): Classroom
    {
        return Classroom::firstOrNew([
            'name' => $this->data['name'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your classroom import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
