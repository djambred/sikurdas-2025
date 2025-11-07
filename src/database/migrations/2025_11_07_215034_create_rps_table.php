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
            $table->string('kode')->nullable();
            $table->string('nama')->nullable();
            $table->integer('sks')->nullable();
            $table->integer('semester')->nullable();

            // optional academic info
            $table->string('academic_year')->nullable();
            $table->enum('status', ['draft','review','approved','rejected'])->default('draft');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->integer('version')->default(1);

            // content stored as JSON (easiest integration with Filament Repeater)
            $table->json('weekly_plan')->nullable();
            $table->json('assessment')->nullable();
            $table->json('references')->nullable();

            // free text
            $table->text('deskripsi_singkat')->nullable();
            $table->string('penyusun')->nullable();
            $table->date('tanggal_penyusunan')->nullable();

            // misc
            $table->text('approval_notes')->nullable();
            $table->json('meta')->nullable();

            $table->timestamps();

            $table->index(['major_id', 'course_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rps');
    }
};
