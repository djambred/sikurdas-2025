<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rps_sub_cpmk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rps_id')->constrained()->cascadeOnDelete();
            $table->foreignId('topic_learning_outcome_id')->constrained()->cascadeOnDelete();
            $table->integer('order')->default(1);
            $table->timestamps();

            $table->unique(['rps_id', 'topic_learning_outcome_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rps_sub_cpmk');
    }
};
