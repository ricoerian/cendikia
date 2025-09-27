<?php

namespace App\Filament\Resources\Classrooms\RelationManagers;

use App\Models\Student;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';

    protected static ?string $title = 'Siswa Terdaftar';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('student_id')
                    ->label('Pilih Siswa')
                    ->options(function (RelationManager $livewire): array {
                        $enrolledStudentIds = $livewire->ownerRecord->enrollments()->pluck('student_id')->toArray();
                        return Student::with('users')
                            ->where('status', 'aktif')
                            ->whereNotIn('id', $enrolledStudentIds)
                            ->get()
                            ->pluck('users.name', 'id')
                            ->toArray();
                    })
                    ->relationship(
                        name: 'student',
                        titleAttribute: 'user.name',
                        modifyQueryUsing: fn (Builder $query) => $query->with('user')
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name ?? 'Unknown')
                    ->searchable()
                    ->required()
                    ->unique(
                        table: 'enrollments',
                        column: 'student_id',
                        ignoreRecord: true,
                        modifyRuleUsing: function ($rule, RelationManager $livewire) {
                            return $rule->where('classroom_id', $livewire->ownerRecord->id);
                        }
                    ),

                Forms\Components\Select::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'lulus' => 'Lulus',
                        'mengulang' => 'Mengulang',
                        'dikeluarkan' => 'Dikeluarkan',
                    ])
                    ->default('aktif')
                    ->required(),

                Forms\Components\DatePicker::make('enrolled_at')
                    ->label('Tanggal Didaftarkan')
                    ->default(now()),

                Forms\Components\Textarea::make('notes')
                    ->label('Catatan')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('student.user.name')
            ->columns([
                Tables\Columns\TextColumn::make('student.user.name')->label('Nama Siswa'),
                Tables\Columns\TextColumn::make('student.nis')->label('NIS'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aktif' => 'primary',
                        'lulus' => 'success',
                        'mengulang' => 'warning',
                        'dikeluarkan' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('enrolled_at')->label('Tanggal Daftar')->date(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Daftarkan Siswa')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['academic_year_id'] = $this->ownerRecord->academic_year_id;

                        return $data;
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->withoutGlobalScopes([
                    SoftDeletingScope::class,
                ]));
    }
}
