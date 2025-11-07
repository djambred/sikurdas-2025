<?php

namespace App\Filament\Admin\Resources\AssessmentCourseResource\Pages;

use App\Filament\Admin\Resources\AssessmentCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssessmentCourse extends EditRecord
{
    protected static string $resource = AssessmentCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
