<?php

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
        Schema::create('penilaian_komponens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rps_id')->constrained('rps_headers')->onDelete('cascade');
            $table->string('nama_komponen'); // 'Quiz', 'Tugas', 'UTS', 'UAS', 'Project'
            $table->decimal('bobot', 5, 2); // persentase
            $table->text('deskripsi')->nullable();
            $table->text('kriteria_penilaian')->nullable();
            $table->foreignId('sub_cpmk_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_komponens');
    }
};
