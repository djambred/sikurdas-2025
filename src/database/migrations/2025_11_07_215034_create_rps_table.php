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
        // Ganti Schema::table() menjadi Schema::create()
        Schema::create('rps', function (Blueprint $table) {
            $table->id();

            // --- Foreign Keys (diambil dari RpsResource dan Rps Model) ---
            $table->foreignId('major_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('set null');

            // --- Identitas Mata Kuliah (Sesuai yang ingin Anda tambahkan) ---
            $table->string('kode', 50)->nullable();
            $table->string('nama')->nullable();
            $table->integer('sks')->nullable();
            $table->integer('semester')->nullable();
            $table->longText('deskripsi_singkat')->nullable();
            $table->integer('revisi')->default(1); // Revisi dinaikkan ke atas agar lebih terstruktur

            // --- Konten RPS (JSON Casted) ---
            $table->json('weekly_plan')->nullable();
            $table->json('assessment')->nullable();
            $table->json('references')->nullable();

            // --- Otorisasi (Foreign Keys ke tabel 'lectures') ---
            $table->foreignId('penyusun_id')->nullable()->constrained('lectures')->onDelete('set null');
            $table->foreignId('koordinator_rps_id')->nullable()->constrained('lectures')->onDelete('set null');
            $table->foreignId('ketua_prodi_id')->nullable()->constrained('lectures')->onDelete('set null');

            $table->date('tanggal_penyusunan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rps');
    }
};
