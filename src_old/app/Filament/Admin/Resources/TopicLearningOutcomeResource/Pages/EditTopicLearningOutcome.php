<?php

namespace App\Filament\Admin\Resources\TopicLearningOutcomeResource\Pages;

use App\Filament\Admin\Resources\TopicLearningOutcomeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopicLearningOutcome extends EditRecord
{
    protected static string $resource = TopicLearningOutcomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
