<?php

namespace App\Filament\Resources\Subjects\Pages;

use App\Filament\Exports\SubjectExporter;
use App\Filament\Imports\SubjectImporter;
use App\Filament\Resources\Subjects\SubjectResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListSubjects extends ListRecords
{
    protected static string $resource = SubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(SubjectExporter::class),

            ImportAction::make()
                ->importer(SubjectImporter::class),

            CreateAction::make(),
        ];
    }
}
