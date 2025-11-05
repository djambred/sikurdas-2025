<?php

use App\Models\Department;
use App\Models\User;
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
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Department::class);
            $table->string('kode_mk')->unique();
            $table->string('nama_mk');
            $table->enum('jenis_mk', ['TEORI', 'PRAKTIKUM', 'HYBRID', 'ONLINE']);
            $table->integer('sks');
            $table->integer('semester');
            $table->text('deskripsi')->nullable();
            $table->foreignId(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliahs');
    }
};
