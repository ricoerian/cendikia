<?php

namespace App\Filament\Resources\Majors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class MajorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk menampilkan nama jurusan
                TextColumn::make('name')
                    ->searchable(), // Membuat kolom ini bisa dicari

                // Kolom untuk menampilkan kode jurusan
                TextColumn::make('code')
                    ->searchable(),
            ])
            ->filters([
                // Filter untuk melihat data yang sudah di-"soft delete"
                TrashedFilter::make(),
            ])
            ->actions([
                // Tombol aksi untuk setiap baris data
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                // Tombol aksi untuk data yang dipilih (checkbox)
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
