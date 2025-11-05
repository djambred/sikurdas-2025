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
        Schema::create('rps_pertemuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rps_id')->constrained('rps_headers')->onDelete('cascade');
            $table->integer('pertemuan_ke'); // 1-14
            $table->foreignId('sub_cpmk_id')->constrained()->onDelete('cascade');
            $table->text('materi_pokok');
            $table->json('metode_pembelajaran'); // ['Ceramah', 'Diskusi', 'Praktikum']
            $table->json('media_pembelajaran'); // ['Slide', 'Video', 'Lab']
            $table->text('bahan_ajar')->nullable();
            $table->integer('durasi_teori')->nullable(); // menit
            $table->integer('durasi_praktikum')->nullable(); // menit
            $table->text('tugas_evaluasi')->nullable();
            $table->text('indikator_penilaian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rps_pertemuans');
    }
};
