<?php

use App\Models\AssessmentCourse;
use App\Models\Category;
use App\Models\LearningForm;
use App\Models\LearningMethod;
use App\Models\Term;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title');
            $table->longText('description');
            $table->foreignIdFor(Term::class);
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(AssessmentCourse::class);
            $table->foreignIdFor(LearningForm::class);
            $table->foreignIdFor(LearningMethod::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
