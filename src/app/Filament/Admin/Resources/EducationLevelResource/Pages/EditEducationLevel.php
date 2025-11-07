<?php

namespace App\Filament\Admin\Resources\EducationLevelResource\Pages;

use App\Filament\Admin\Resources\EducationLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEducationLevel extends EditRecord
{
    protected static string $resource = EducationLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
