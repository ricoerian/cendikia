<?php

namespace App\Filament\Resources\Classrooms\RelationManagers;

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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeachingSchedulesRelationManager extends RelationManager
{
    protected static string $relationship = 'teachingSchedules';

    protected static ?string $title = 'Jadwal Pelajaran';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('day_of_week')
                    ->label('Hari')
                    ->options([
                        'Senin' => 'Senin', 'Selasa' => 'Selasa', 'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis', 'Jumat' => 'Jumat', 'Sabtu' => 'Sabtu',
                    ])
                    ->required(),
                TimePicker::make('start_time')->label('Jam Mulai')->seconds(false)->required(),
                TimePicker::make('end_time')->label('Jam Selesai')->seconds(false)->required()->after('start_time'),
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->label('Mata Pelajaran')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('teacher_id')
                    ->relationship(
                        name: 'teacher',
                        titleAttribute: 'name',
                        modifyQueryUsing: function (Builder $query) {
                            return $query->join('users', 'teachers.user_id', '=', 'users.id')
                                ->where('users.role', 'teacher')
                                ->select('teachers.id', 'users.name')
                                ->orderBy('users.name');
                        }
                    )
                    ->label('Guru Pengajar')
                    ->searchable()
                    ->preload()
                    ->required(),
                Textarea::make('notes')->label('Catatan')->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('subject_id')
            ->columns([
                TextColumn::make('day_of_week')->label('Hari')->sortable(),
                TextColumn::make('start_time')->label('Jam Mulai')->time('H:i'),
                TextColumn::make('end_time')->label('Jam Selesai')->time('H:i'),
                TextColumn::make('subject.name')->label('Mata Pelajaran')->sortable(),
                TextColumn::make('teacher.user.name')->label('Guru Pengajar')->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Jadwal')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['academic_year_id'] = $this->ownerRecord->academic_year_id;
                        return $data;
                    }),
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
