<?php

namespace Database\Seeders;

use App\Models\LearningForm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LearningForm::firstOrCreate([
            'name' => 'Kuliah Tatap Muka',
            'code' => 'KTM',
        ]);
        LearningForm::firstOrCreate([
            'name' => 'Kuliah Online',
            'code' => 'KD',
        ]);
        LearningForm::firstOrCreate([
            'name' => 'Kuliah Hybrid',
            'code' => 'KH',
        ]);
    }
}
