<?php

namespace App\Filament\Admin\Resources\MappingPLtoCPLResource\Pages;

use App\Filament\Admin\Resources\MappingPLtoCPLResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMappingPLtoCPL extends EditRecord
{
    protected static string $resource = MappingPLtoCPLResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
