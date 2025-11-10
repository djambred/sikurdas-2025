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
        Schema::create('topic_learning_outcomes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->text('detail');

            // Relasi ke CPMK induk
            $table->foreignId('course_learning_outcome_id')
                  ->constrained('course_learning_outcomes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Additional fields untuk better management
            $table->integer('order')->default(0); // Urutan dalam CPMK
            $table->enum('complexity_level', ['basic', 'intermediate', 'advanced'])->default('basic');
            $table->enum('assessment_type', ['knowledge', 'skill', 'competence'])->default('skill');
            $table->boolean('has_english_component')->default(false);
            $table->boolean('has_global_context')->default(false);

            $table->timestamps();

            // Index untuk performa
            $table->index('course_learning_outcome_id');
            $table->index('complexity_level');
            $table->index(['course_learning_outcome_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topic_learning_outcomes');
    }
};
