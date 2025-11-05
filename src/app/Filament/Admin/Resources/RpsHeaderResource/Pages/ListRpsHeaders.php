<?php

namespace App\Filament\Admin\Resources\RpsHeaderResource\Pages;

use App\Filament\Admin\Resources\RpsHeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRpsHeaders extends ListRecords
{
    protected static string $resource = RpsHeaderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
