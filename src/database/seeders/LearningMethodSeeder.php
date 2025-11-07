<?php

namespace Database\Seeders;

use App\Models\LearningMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LearningMethod::firstOrCreate([
            'name' => 'Teori',
            'code' => 'TEO',
        ]);
        LearningMethod::firstOrCreate([
            'name' => 'Praktikum',
            'code' => 'PRAK',
        ]);
    }
}
