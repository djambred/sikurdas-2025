<?php

use App\Models\Cpmk;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_cpmks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cpmk::class);
            $table->string('kode_sub');
            $table->text('deskripsi');
            $table->text('indikator_penilaian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_cpmks');
    }
};
