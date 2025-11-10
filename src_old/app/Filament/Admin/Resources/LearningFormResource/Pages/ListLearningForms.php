<?php

namespace App\Filament\Admin\Resources\LearningFormResource\Pages;

use App\Filament\Admin\Resources\LearningFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLearningForms extends ListRecords
{
    protected static string $resource = LearningFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
