<?php

namespace App\Filament\Admin\Resources\SubCpmkResource\Pages;

use App\Filament\Admin\Resources\SubCpmkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubCpmks extends ListRecords
{
    protected static string $resource = SubCpmkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
