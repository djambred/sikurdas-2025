<?php

namespace App\Filament\Admin\Resources\CpmkResource\Pages;

use App\Filament\Admin\Resources\CpmkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCpmks extends ListRecords
{
    protected static string $resource = CpmkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
