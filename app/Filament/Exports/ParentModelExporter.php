<?php

namespace App\Filament\Exports;

use App\Models\ParentModel;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class ParentModelExporter extends Exporter
{
    protected static ?string $model = ParentModel::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('user.name')
                ->label('Nama Orang Tua'),
            ExportColumn::make('user.email')
                ->label('Email'),
            ExportColumn::make('nik')
                ->label('NIK'),
            ExportColumn::make('phone_number')
                ->label('No. Telepon'),
            ExportColumn::make('occupation')
                ->label('Pekerjaan'),
            ExportColumn::make('address')
                ->label('Alamat'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your parent model export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
