<?php

namespace App\Filament\Admin\Resources\MappingCourseResource\Pages;

use App\Filament\Admin\Resources\MappingCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMappingCourses extends ListRecords
{
    protected static string $resource = MappingCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
