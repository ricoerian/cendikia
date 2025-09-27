<?php

namespace App\Filament\Resources\PpdbRegistrations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\ParentModel;
use App\Models\PpdbRegistrations;
use App\Models\Student;
use App\Models\User;

class PpdbRegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')->label('Foto')->circular(),
                TextColumn::make('registration_number')->label('No. Pendaftaran')->searchable(),
                TextColumn::make('name')->label('Nama Pendaftar')->searchable(),
                TextColumn::make('nisn')->label('NISN')->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    }),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                Action::make('accept')
                    ->label('Terima & Jadikan Siswa')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Penerimaan Siswa')
                    ->modalDescription('Apakah Anda yakin ingin menerima pendaftar ini dan membuat akun siswa serta orang tua secara otomatis?')
                    ->visible(fn (PpdbRegistrations $record): bool => $record->status === 'pending')
                    ->action(function (PpdbRegistrations $record) {
                        try {
                            DB::transaction(function () use ($record) {
                                $studentUser = User::create([
                                    'name' => $record->name,
                                    'email' => $record->email,
                                    'password' => Hash::make('password'),
                                    'role' => 'student',
                                ]);

                                $student = Student::create([
                                    'user_id' => $studentUser->id,
                                    'nis' => 'S' . date('Ym') . $record->id,
                                    'nisn' => $record->nisn,
                                    'status' => 'aktif',
                                    'gender' => $record->gender,
                                    'place_of_birth' => $record->place_of_birth,
                                    'date_of_birth' => $record->date_of_birth,
                                    'religion' => $record->religion,
                                    'address' => $record->address,
                                    'photo' => $record->photo,
                                ]);

                                $parentUser = User::firstOrCreate(
                                    ['email' => $record->father_nik . '@sekolah.app'],
                                    [
                                        'name' => $record->father_name,
                                        'password' => Hash::make('password'),
                                        'role' => 'parent',
                                    ]
                                );

                                $parentModel = ParentModel::create([
                                    'user_id' => $parentUser->id,
                                    'nik' => $record->father_nik,
                                    'phone_number' => $record->father_phone_number ?? 'N/A',
                                    'address' => $record->father_address,
                                    'occupation' => $record->father_occupation,
                                ]);
                                $student->parentModels()->attach($parentModel->id);
                                $record->update(['status' => 'diterima']);
                            });

                            Notification::make()
                                ->title('Penerimaan Berhasil')
                                ->body('Siswa dan Orang Tua telah berhasil dibuat.')
                                ->success()
                                ->send();

                        } catch (\Throwable $e) {
                            Notification::make()
                                ->title('Penerimaan Gagal')
                                ->body('Terjadi kesalahan: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
