<?php

namespace App\Filament\Admin\Resources\LearningOutcomeIndicatorResource\Pages;

use App\Filament\Admin\Resources\LearningOutcomeIndicatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLearningOutcomeIndicator extends EditRecord
{
    protected static string $resource = LearningOutcomeIndicatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
