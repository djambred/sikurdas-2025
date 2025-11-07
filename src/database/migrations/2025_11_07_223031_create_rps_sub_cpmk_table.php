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
        Schema::create('rps_sub_cpmk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rps_id')->constrained()->onDelete('cascade');
            $table->foreignId('topic_learning_outcome_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rps_sub_cpmk');
    }
};
