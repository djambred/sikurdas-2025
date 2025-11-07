<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        University::firstOrCreate([
            'name' => 'Esa Unggul University',
            'vission' => 'Menjadi perguruan tinggi kelas dunia berbasis intelektualitas, kreatifitas dan kewirausahaan, yang unggul dalam mutu pengelolaan dan hasil pelaksanaan Tridharma Perguruan Tinggi pada tahun 2033',
            'mission' => '1. Menyelenggarakan pendidikan yang bermutu dan relevan.<br>
            2. Menyelenggarakan kegiatan penelitian dan pengabdian kepada masyarakat yang relevan dengan tantangan nasional serta global.<br>
            3. Menciptakan suasana akademik yang kondusif.<br>
            4. Memberikan pelayanan prima bagi seluruh pemangku kepentingan.',
            'objectives' => '1. Dihasilkannya sumber daya manusia yang berkarakter dan berdaya saing tinggi.<br>
            2. Adanya kontribusi terhadap pengembangan ilmu pengetahuan, teknologi dan seni, serta kesejahteraan umat manusia.<br>
            3. Tumbuh berkembangnya Universitas Esa Unggul menjadi perguruan tinggi yang sehat dan mandiri.<br>
            4. Perguruan Tinggi yang bereputasi unggul.',
        ]);
    }
}
