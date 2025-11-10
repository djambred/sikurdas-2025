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

        Major::firstOrCreate([
            'name' => 'Teknik Informatika',
            'vission' => 'Menjadi Program Studi Teknik Informatika yang mampu menghasilkan lulusan berwawasan global, berbasis intelektualitas, kreatifitas, dan kewirausahaan pada tahun 2033 dengan keahlian pengembangan solusi digital adaptif untuk mendukung  akselerasi di berbagai konteks organisasi.',
            'mission' => '1. Menyelenggarakan proses pendidikan yang menghasilkan lulusan sarjana Teknik Informatika yang bertakwa kepada Tuhan Yang Maha Esa, berjiwa technopreneur, serta memiliki kemampuan akademik dan teknis dalam membangun solusi digital adaptif yang mendukung transformasi menuju ekonomi digital.<br>
2. Melaksanakan penelitian terapan dan inovatif dalam bidang informatika untuk mengembangkan dan memperkaya IPTEKS, dengan fokus pada pengembangan solusi yang bermanfaat bagi ekosistem digital di berbagai konteks organisasi.<br>
3. Menyelenggarakan pengabdian dan pemberdayaan masyarakat berbasis informatika secara berkelanjutan yang memberikan dampak langsung pada penguatan kapasitas digital dalam organisasi.',
            'objectives' => '1. Menghasilkan lulusan Teknik Informatika yang menguasai bidang rekayasa perangkat lunak, jaringan komputer, basis data, kecerdasan buatan, dan pemrograman untuk memberikan solusi sistem berbasis teknologi informasi yang adaptif terhadap perkembangan global.<br>
2. Membentuk lulusan yang mampu menjadi wirausahawan teknologi (technopreneur) yang inovatif, kompeten, dan berdaya saing dalam menghadapi tantangan ekonomi digital, khususnya di sektor SME’s.<br>
3. Memberikan kontribusi melalui riset dan publikasi ilmiah dalam menyelesaikan permasalahan teknologi informasi pada tingkat nasional dan internasional.<br>
4. Membangun lulusan dengan kompetensi aplikatif dalam merancang, mengimplementasikan, dan mengembangkan sistem teknologi informasi pada bidang Artificial Intelligence, Computer Networking, Database Systems, Programming, dan Software Engineering.<br>
5. Menjadi program studi yang proaktif dalam menjawab kebutuhan pengguna lulusan, baik di industri maupun di bidang kewirausahaan digital.',
            'faculty_id' => 1,
        ]);
    }
}
