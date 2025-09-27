<?php

namespace App\Filament\Resources\ParentModels\Pages;

use App\Filament\Exports\ParentModelExporter;
use App\Filament\Imports\ParentModelImporter;
use App\Filament\Resources\ParentModels\ParentModelResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListParentModels extends ListRecords
{
    protected static string $resource = ParentModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(ParentModelExporter::class),

            ImportAction::make()
                ->importer(ParentModelImporter::class),

            CreateAction::make(),
        ];
    }
}
