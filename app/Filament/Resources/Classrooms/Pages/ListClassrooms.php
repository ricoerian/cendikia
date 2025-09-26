<?php

namespace App\Filament\Resources\Classrooms\Pages;

use App\Filament\Exports\ClassroomExporter;
use App\Filament\Imports\ClassroomImporter;
use App\Filament\Resources\Classrooms\ClassroomResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;

class ListClassrooms extends ListRecords
{
    protected static string $resource = ClassroomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(ClassroomExporter::class),

            ImportAction::make()
                ->importer(ClassroomImporter::class),

            CreateAction::make(),
        ];
    }
}
