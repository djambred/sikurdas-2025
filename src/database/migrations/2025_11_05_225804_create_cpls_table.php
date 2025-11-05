<?php

use App\Models\Department;
use App\Models\ProfilLulusan;
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
        Schema::create('cpls', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Department::class);
            $table->string('kode_cpl')->unique();
            $table->text('deskripsi');
            $table->enum('aspek', ['Sikap', 'Pengetahuan', 'Keterampilan Umum', 'Keterampilan Khusus']);
            $table->foreignIdFor(ProfilLulusan::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpls');
    }
};
