<?php

namespace App\Filament\Admin\Resources\LearningMethodResource\Pages;

use App\Filament\Admin\Resources\LearningMethodResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLearningMethods extends ListRecords
{
    protected static string $resource = LearningMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
