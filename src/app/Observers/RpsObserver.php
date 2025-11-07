<?php

namespace App\Observers;

use App\Models\Rps;

class RpsObserver
{
    public function saved(Rps $rps)
    {
        // Sync CPMK yang dipilih
        if (request()->has('existing_cpmks')) {
            $rps->cpmks()->sync(request('existing_cpmks'));
        }

        // Sync Sub-CPMK yang dipilih
        if (request()->has('existing_sub_cpmks')) {
            $rps->subCpmks()->sync(request('existing_sub_cpmks'));
        }
    }
}
