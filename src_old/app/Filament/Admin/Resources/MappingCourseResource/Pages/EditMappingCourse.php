<?php

namespace App\Filament\Admin\Resources\MappingCourseResource\Pages;

use App\Filament\Admin\Resources\MappingCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMappingCourse extends EditRecord
{
    protected static string $resource = MappingCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
