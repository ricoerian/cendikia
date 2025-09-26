<?php

namespace App\Filament\Resources\Teachers\Pages;

use App\Filament\Exports\TeacherExporter;
use App\Filament\Imports\TeacherImporter;
use App\Filament\Resources\Teachers\TeacherResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;

class ListTeachers extends ListRecords
{
    protected static string $resource = TeacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(TeacherExporter::class),

            ImportAction::make()
                ->importer(TeacherImporter::class),
            
            CreateAction::make(),
        ];
    }
}
