<?php

namespace App\Filament\Admin\Resources\ScienceClusterResource\Pages;

use App\Filament\Admin\Resources\ScienceClusterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScienceClusters extends ListRecords
{
    protected static string $resource = ScienceClusterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
