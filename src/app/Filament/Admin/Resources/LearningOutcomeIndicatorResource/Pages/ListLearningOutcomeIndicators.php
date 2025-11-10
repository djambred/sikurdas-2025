<?php

namespace App\Filament\Admin\Resources\LearningOutcomeIndicatorResource\Pages;

use App\Filament\Admin\Resources\LearningOutcomeIndicatorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLearningOutcomeIndicators extends ListRecords
{
    protected static string $resource = LearningOutcomeIndicatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
