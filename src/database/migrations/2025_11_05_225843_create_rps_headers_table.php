<?php

use App\Models\MataKuliah;
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
        Schema::create('rps_headers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MataKuliah::class);
            $table->string('tahun_akademik');
            $table->string('versi_rps')->default('1.0');
            $table->enum('status', ['DRAFT', 'REVIEW', 'APPROVED', 'REJECTED'])->default('DRAFT');
            $table->date('tanggal_disusun')->nullable();
            $table->date('tanggal_approve')->nullable();
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rps_headers');
    }
};
