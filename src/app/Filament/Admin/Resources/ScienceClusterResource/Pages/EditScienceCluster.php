<?php

namespace App\Filament\Admin\Resources\ScienceClusterResource\Pages;

use App\Filament\Admin\Resources\ScienceClusterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScienceCluster extends EditRecord
{
    protected static string $resource = ScienceClusterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
