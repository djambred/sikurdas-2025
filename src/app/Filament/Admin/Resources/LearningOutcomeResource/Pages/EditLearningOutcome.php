<?php

namespace App\Filament\Admin\Resources\LearningOutcomeResource\Pages;

use App\Filament\Admin\Resources\LearningOutcomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLearningOutcome extends EditRecord
{
    protected static string $resource = LearningOutcomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
