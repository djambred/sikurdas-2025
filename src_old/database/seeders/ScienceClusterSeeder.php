<?php

namespace Database\Seeders;

use App\Models\ScienceCluster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScienceClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScienceCluster::firstOrCreate([
            'name' => 'Ilmu Komputer atau Informatika',
            'code' => '199',
        ]);
        ScienceCluster::firstOrCreate([
            'name' => 'Kecerdasan Buatan',
            'code' => '200',
        ]);
        ScienceCluster::firstOrCreate([
            'name' => 'Rekayasa Perangkat Lunak',
            'code' => '201',
        ]);
        ScienceCluster::firstOrCreate([
            'name' => 'Rekayasa Sistem Komputer',
            'code' => '202',
        ]);
        ScienceCluster::firstOrCreate([
            'name' => 'Sistem Informasi',
            'code' => '203',
        ]);
        ScienceCluster::firstOrCreate([
            'name' => 'Sistem dan Teknologi Informasi',
            'code' => '204',
        ]);
        ScienceCluster::firstOrCreate([
            'name' => 'Teknologi Informasi',
            'code' => '205',
        ]);
    }
}
