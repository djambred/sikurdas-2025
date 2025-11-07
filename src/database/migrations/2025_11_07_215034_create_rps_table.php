<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rps', function (Blueprint $table) {
            $table->id();

            // FK to Major (program studi)
            $table->foreignId('major_id')->constrained('majors')->cascadeOnDelete();

            // FK to Course (mata kuliah)
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();

            // basic metadata
            $table->string('kode');
            $table->string('nama');
            $table->integer('sks');
            $table->integer('semester');

            // Tambahan field untuk otorisasi dan informasi lain
            $table->string('penyusun'); // sekarang menyimpan nama, bukan ID
            $table->string('koordinator_rps')->nullable();
            $table->string('ketua_prodi')->nullable();
            $table->string('dosen_pengampu')->nullable();
            $table->date('tanggal_penyusunan');
            $table->integer('revisi')->default(1);

            // Deskripsi
            $table->text('deskripsi_singkat')->nullable();

            // content stored as JSON (easiest integration with Filament Repeater)
            $table->json('weekly_plan')->nullable();
            $table->json('assessment')->nullable();
            $table->json('references')->nullable();

            // Field untuk multiple selection CPMK dan Sub-CPMK
            $table->json('existing_cpmks')->nullable();
            $table->json('existing_sub_cpmks')->nullable();

            // optional academic info
            $table->string('academic_year')->nullable();
            $table->enum('status', ['draft','review','approved','rejected'])->default('draft');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->integer('version')->default(1);

            // misc
            $table->text('approval_notes')->nullable();
            $table->json('meta')->nullable();

            $table->timestamps();

            $table->index(['major_id', 'course_id', 'status']);
            $table->index(['kode', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rps');
    }
};
