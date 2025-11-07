<?php

namespace App\Filament\Admin\Resources\ReferenceResource\Pages;

use App\Filament\Admin\Resources\ReferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReferences extends ListRecords
{
    protected static string $resource = ReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
