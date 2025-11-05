<?php

namespace App\Filament\Admin\Resources\PenilaianKomponenResource\Pages;

use App\Filament\Admin\Resources\PenilaianKomponenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenilaianKomponen extends EditRecord
{
    protected static string $resource = PenilaianKomponenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
