<?php

namespace App\Filament\Resources\ParentModels;

use App\Filament\Resources\ParentModels\Pages\CreateParentModel;
use App\Filament\Resources\ParentModels\Pages\EditParentModel;
use App\Filament\Resources\ParentModels\Pages\ListParentModels;
use App\Filament\Resources\ParentModels\Schemas\ParentModelForm;
use App\Filament\Resources\ParentModels\Tables\ParentModelsTable;
use App\Filament\Resources\ParentModels\RelationManagers\StudentsRelationManager;
use App\Models\ParentModel;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParentModelResource extends Resource
{
    protected static ?string $model = ParentModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static ?string $recordTitleAttribute = 'nik';
    protected static ?string $modelLabel = 'Orang Tua';
    protected static ?string $navigationLabel = 'Orang Tua';
    protected static UnitEnum|string|null $navigationGroup = 'Manajemen Pengguna';

    public static function form(Schema $schema): Schema
    {
        return ParentModelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ParentModelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            StudentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListParentModels::route('/'),
            'create' => CreateParentModel::route('/create'),
            'edit' => EditParentModel::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
