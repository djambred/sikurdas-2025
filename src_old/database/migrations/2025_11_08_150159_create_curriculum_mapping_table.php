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
        Schema::create('curriculum_mapping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reference_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('graduate_profile_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('learning_outcome_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('course_learning_outcome_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('topic_learning_outcome_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('cascade');

            // Data penilaian keterkaitan
            $table->integer('strength_level')->default(3); // 1-5 scale
            $table->boolean('is_direct_relation')->default(true);
            $table->string('assessment_method')->nullable();
            $table->text('evidence')->nullable();
            $table->text('notes')->nullable();

            // Metadata
            $table->string('mapping_code')->unique()->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();

            // Indexes untuk performa - MENGGUNAKAN NAMA PENDEK
            $table->index('strength_level', 'idx_strength_level');
            $table->index('is_direct_relation', 'idx_direct_relation');
            $table->index('is_verified', 'idx_verified');
            $table->index(['reference_id', 'graduate_profile_id'], 'idx_ref_grp');
            $table->index(['course_learning_outcome_id', 'topic_learning_outcome_id'], 'idx_cpmk_subcpmk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_mapping');
    }
};
