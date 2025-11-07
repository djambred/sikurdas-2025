<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faculty::firstOrCreate(['name' => 'Fakultas Ilmu Komputer',
            'vission' => 'Menjadi Fakultas Ilmu Komputer yang unggul dalam penguasaan dan pengembangan teknologi ilmu komputer berbasis kreativitas, intelektual dan kewirausahaan, serta berwawasan global pada tahun 2033',
            'mission' => '1. Menyelenggarakan pendidikan tinggi dan profesional di bidang ilmu komputer dan teknologi informasi yang berkualitas, adaptif, dan berorientasi pada peningkatan kreativitas serta daya saing global.<br>
2. Menghasilkan penelitian, kegiatan Pengabdian Kepada Masyarakat dan inovasi teknologi berbasis intelektual yang mendukung kemajuan ilmu komputer dan bermanfaat bagi masyarakat serta industri.<br>
3. Mendorong semangat kewirausahaan digital dan membina kolaborasi dengan mitra nasional maupun internasional untuk menghasilkan lulusan yang profesional dan berdaya saing global.<br>
4. Meningkatkan mutu tata kelola manajemen yang efektif, efisien, dan membangun reputasi bertaraf internasional',
            'objectives' => '1. Menghasilkan lulusan yang kompeten, inovatif, dan berdaya saing tinggi di tingkat nasional dan internasional melalui proses pendidikan yang berkualitas, berbasis teknologi.<br>
2. Meningkatkan kontribusi akademik dan profesional fakultas dalam pengembangan ilmu komputer serta penerapan teknologi yang solutif, inovatif, dan berdampak langsung bagi masyarakat dan dunia industri.<br>
3. Mewujudkan lulusan yang memiliki jiwa kewirausahaan yang adaptif terhadap perkembangan teknologi global, serta mampu berkolaborasi lintas sektor dan lintas negara dalam menghadapi tantangan industri masa depan.<br>
4. Mewujudkan sistem tata kelola Fakultas Ilmu Komputer yang profesional, transparan, akuntabel, berbasis teknologi informasi, dan mendukung pencapaian reputasi akademik dan kelembagaan di tingkat internasional.',
            'university_id' => 1,
        ]);
    }
}
