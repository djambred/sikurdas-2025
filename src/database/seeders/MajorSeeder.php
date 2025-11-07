<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Major::firstOrCreate([
            'name' => 'Sistem Informasi',
            'vission' => 'Menjadi pilar dalam pengembangan keilmuan dan inovasi di bidang Sistem Informasi yang berorientasi pada terciptanya kemampuan individu, organisasi, dan masyarakat berbasis pengetahuan dan teknologi melalui pembelajaran berkelanjutan pada tahun 2033.',
            'mission' => '1. Menyelenggarakan pendidikan Sarjana di bidang Sistem Informasi yang berkualitas dengan mendayagunakan teknologi informasi dan komunikasi.<br>
2. Melakukan diseminasi penelitian di bidang Sistem Informasi secara aktif dalam tingkat nasional maupun internasional.<br>
3. Mendorong dan memajukan penerapan dan pengembangan teknologi informasi dalam berbagai sektor melalui kegiatan penelitian dan pelayanan kepada masyarakat secara berkelanjutan.',
            'objectives' => '1. Menghasilkan lulusan Sarjana Sistem Informasi yang berwawasan global yang dibekali dengan kemampuan yang mendukung karir lulusan dalam multi-sektor serta berkontribusi bagi pengembangan masyarakat.<br>
2. Menghasilkan lulusan yang dapat diterima untuk studi lanjut serta mampu menyelesaikan studinya dengan baik di perguruan tinggi dalam maupun luar negeri.<br>
3. Menghasilkan lulusan yang memiliki kemampuan belajar sepanjang hayat dan adaptif terhadap dinamika bisnis serta perubahan teknologi dan kebutuhan masyarakat.<br>
4. Menghasilkan penelitian serta penerapan dan inovasi teknologi informasi tepat guna dalam rangka terciptanya kemampuan individu, organisasi, dan masyarakat berbasis pengetahuan dan teknologi.',
            'faculty_id' => 1,
        ]);
    }
}
