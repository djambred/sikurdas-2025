<?php

namespace App\Filament\Admin\Resources\PrasyaratMataKuliahResource\Pages;

use App\Filament\Admin\Resources\PrasyaratMataKuliahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrasyaratMataKuliahs extends ListRecords
{
    protected static string $resource = PrasyaratMataKuliahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
