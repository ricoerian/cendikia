<?php

namespace App\Filament\Resources\Classrooms\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class ClassroomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Rombel')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: X PPLG 1'),

                Select::make('academic_year_id')
                    ->label('Tahun Ajaran')
                    ->relationship('academicYear', 'year')
                    ->required(),

                Select::make('grade_id')
                    ->label('Tingkat')
                    ->relationship('grade', 'name')
                    ->required(),

                Select::make('major_id')
                    ->label('Jurusan')
                    ->relationship('major', 'name')
                    ->required(),

                Select::make('teacher_id')
                    ->label('Wali Kelas')
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
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
