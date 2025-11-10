<?php

namespace App\Filament\Admin\Resources\MappingPLtoCPLResource\Pages;

use App\Filament\Admin\Resources\MappingPLtoCPLResource;
use App\Models\MappingPLtoCPL;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model; // ✅ tambahkan ini!

class CreateMappingPLtoCPL extends CreateRecord
{
    protected static string $resource = MappingPLtoCPLResource::class;

    /**
     * Handle custom record creation for repeater mapping.
     */
    protected function handleRecordCreation(array $data): Model
    {
        // Pastikan 'mappings' ada
        if (!isset($data['mappings']) || empty($data['mappings'])) {
            throw new \Exception('Tidak ada data mapping PL dan CPL yang diinput.');
        }

        // Simpan semua kombinasi PL dan CPL
        foreach ($data['mappings'] as $mapping) {
            $graduateProfileId = $mapping['graduate_profile_id'] ?? null;
            $learningOutcomeIds = $mapping['learning_outcome_ids'] ?? [];

            if ($graduateProfileId && !empty($learningOutcomeIds)) {
                foreach ($learningOutcomeIds as $cplId) {
                    MappingPLtoCPL::updateOrCreate(
                        [
                            'graduate_profile_id' => $graduateProfileId,
                            'learning_outcome_id' => $cplId,
                        ],
                        [] // tidak perlu data tambahan
                    );
                }
            }
        }

        // Return dummy record supaya Filament tidak error redirect
        return new MappingPLtoCPL();
    }

    protected function getRedirectUrl(): string
    {
        // Setelah simpan, balik ke halaman index
        return static::getResource()::getUrl('index');
    }
}
