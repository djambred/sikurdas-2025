<?php

namespace App\Filament\Admin\Resources\PenilaianKomponenResource\Pages;

use App\Filament\Admin\Resources\PenilaianKomponenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenilaianKomponens extends ListRecords
{
    protected static string $resource = PenilaianKomponenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
