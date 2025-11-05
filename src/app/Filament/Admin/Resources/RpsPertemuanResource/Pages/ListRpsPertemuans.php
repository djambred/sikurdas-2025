<?php

namespace App\Filament\Admin\Resources\RpsPertemuanResource\Pages;

use App\Filament\Admin\Resources\RpsPertemuanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRpsPertemuans extends ListRecords
{
    protected static string $resource = RpsPertemuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
