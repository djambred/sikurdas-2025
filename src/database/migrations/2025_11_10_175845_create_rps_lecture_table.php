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
        Schema::create('rps_lecture', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel 'rps'
            $table->foreignId('rps_id')->constrained()->cascadeOnDelete();

            // Foreign Key ke tabel 'lectures'
            $table->foreignId('lecture_id')->constrained('lectures')->cascadeOnDelete();

            $table->timestamps();

            // Memastikan kombinasi rps_id dan lecture_id harus unik
            $table->unique(['rps_id', 'lecture_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rps_lecture');
    }
};
