<?php

namespace App\Filament\Resources\Grades\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class GradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk menampilkan nama tingkat
                TextColumn::make('name')->searchable(), // Membuat kolom ini bisa dicari
            ])
            ->filters([
                // Filter untuk melihat data yang sudah di-"soft delete"
                TrashedFilter::make(),
            ])
            ->recordActions([
                // Tombol aksi untuk setiap baris data
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                // Tombol aksi untuk data yang dipilih (checkbox)
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
