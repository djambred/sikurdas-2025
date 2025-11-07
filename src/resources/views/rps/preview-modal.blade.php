<div class="p-4">
    <h3 class="text-lg font-bold mb-4">{{ $rps->nama }} - {{ $rps->kode }}</h3>

    <div class="space-y-3">
        <div><strong>Program Studi:</strong> {{ $rps->major->name ?? '-' }}</div>
        <div><strong>SKS:</strong> {{ $rps->sks }}</div>
        <div><strong>Semester:</strong> {{ $rps->semester }}</div>

        @if($rps->deskripsi_singkat)
        <div><strong>Deskripsi:</strong> {{ $rps->deskripsi_singkat }}</div>
        @endif

        @if($rps->cpmks && $rps->cpmks->count() > 0)
        <div>
            <strong>CPMK:</strong>
            <ul class="list-disc list-inside mt-1">
                @foreach($rps->cpmks as $cpmk)
                <li>{{ $cpmk->code }} - {{ $cpmk->description }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
