<?php

use App\Models\Cpl;
use App\Models\MataKuliah;
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
        Schema::create('cpmks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MataKuliah::class);
            $table->string('kode_cpmk');
            $table->text('deskripsi');
            $table->foreignIdFor(Cpl::class);
            $table->decimal('bobot', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpmks');
    }
};
