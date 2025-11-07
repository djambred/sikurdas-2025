<?php

namespace App\Filament\Admin\Resources\RpsResource\Pages;

use App\Filament\Admin\Resources\RpsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRps extends CreateRecord
{
    protected static string $resource = RpsResource::class;
    protected function afterCreate(): void
    {
        $data = $this->form->getState();
        $record = $this->record;

        if (!empty($data['cpmk_ids'])) {
            $record->cpmks()->sync($data['cpmk_ids']);
        }

        if (!empty($data['sub_cpmk_ids'])) {
            $record->subCpmks()->sync($data['sub_cpmk_ids']);
        }
    }

}
