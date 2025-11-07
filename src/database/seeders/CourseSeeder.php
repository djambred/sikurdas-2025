<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => 'CSF101', 'nama' => 'Algoritma dan Pemrograman', 'sks' => 3, 'semester' => 1],
            ['kode' => 'CSF103', 'nama' => 'Aljabar Linier dan Matriks', 'sks' => 3, 'semester' => 1],
            ['kode' => 'CSF414', 'nama' => 'Analisis dan Perancangan Sistem Informasi', 'sks' => 3, 'semester' => 4],
            ['kode' => 'CIS202', 'nama' => 'Analisis Kebutuhan Informasi', 'sks' => 3, 'semester' => 2],
            ['kode' => 'CIS512', 'nama' => 'Analisis Resiko Sistem Informasi', 'sks' => 3, 'semester' => 5],
            ['kode' => 'CIS511', 'nama' => 'Arsitektur Enterprise', 'sks' => 3, 'semester' => 5],
            ['kode' => 'CIS510', 'nama' => 'Audit dan Kendali Sistem Informasi', 'sks' => 3, 'semester' => 5],
            ['kode' => 'CSF309', 'nama' => 'Basis Data', 'sks' => 3, 'semester' => 3],
            ['kode' => 'CSF620', 'nama' => 'Big Data', 'sks' => 3, 'semester' => 6],
            ['kode' => 'CSF102', 'nama' => 'Dasar Sistem Informasi', 'sks' => 3, 'semester' => 1],
            ['kode' => 'CSF517', 'nama' => 'Data Mining', 'sks' => 3, 'semester' => 5],
            ['kode' => 'CSF415', 'nama' => 'Data Warehouse', 'sks' => 3, 'semester' => 4],
            ['kode' => 'CIS509', 'nama' => 'E-Bisnis', 'sks' => 3, 'semester' => 5],
            ['kode' => 'CIS616', 'nama' => 'Evaluasi Sistem Informasi', 'sks' => 3, 'semester' => 6],
            ['kode' => 'CIS513', 'nama' => 'Implementasi Sistem Informasi', 'sks' => 3, 'semester' => 5],
            ['kode' => 'CIS508', 'nama' => 'Infrastruktur dan Manajemen Layanan TI', 'sks' => 3, 'semester' => 5],
            ['kode' => 'CIS407', 'nama' => 'Integrasi dan Kustomisasi ERP', 'sks' => 3, 'semester' => 4],
            ['kode' => 'CIS723', 'nama' => 'Intelegensia Bisnis', 'sks' => 3, 'semester' => 7],
            ['kode' => 'CSF619', 'nama' => 'Interaksi Manusia Komputer', 'sks' => 3, 'semester' => 6],
            ['kode' => 'CIS619', 'nama' => 'Internet of Things', 'sks' => 3, 'semester' => 6],
            ['kode' => 'CIS615', 'nama' => 'Isu Sosial dan Keprofesian Sistem Informasi', 'sks' => 3, 'semester' => 6],
            ['kode' => 'CIS722', 'nama' => 'IT untuk Pemulihan Bencana', 'sks' => 3, 'semester' => 7],
            ['kode' => 'CIS617', 'nama' => 'Jaminan dan Keamanan Informasi', 'sks' => 3, 'semester' => 6],
            ['kode' => 'CSF413', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 4],
            ['kode' => 'CIS721', 'nama' => 'Kapita Selekta Sistem Informasi', 'sks' => 3, 'semester' => 7],
            ['kode' => 'CSF721', 'nama' => 'Magang', 'sks' => 3, 'semester' => 7],
            ['kode' => 'CIS720', 'nama' => 'Manajemen Pengetahuan', 'sks' => 3, 'semester' => 7],
            ['kode' => 'CIS406', 'nama' => 'Manajemen Proyek Sistem Informasi', 'sks' => 3, 'semester' => 4],
            ['kode' => 'CIS304', 'nama' => 'Manajemen Sumber Daya Informasi', 'sks' => 3, 'semester' => 3],
            ['kode' => 'CIS618', 'nama' => 'Masyarakat Virtual', 'sks' => 3, 'semester' => 6],
            ['kode' => 'CSF207', 'nama' => 'Matematika Diskrit', 'sks' => 3, 'semester' => 1],
            ['kode' => 'CIS405', 'nama' => 'Metode Sampling dan Survei SI', 'sks' => 3, 'semester' => 4],
            ['kode' => 'CSF618', 'nama' => 'Metodologi Penelitian', 'sks' => 3, 'semester' => 6],
            ['kode' => 'CSF206', 'nama' => 'Organisasi dan Arsitektur Komputer', 'sks' => 3, 'semester' => 2],
            ['kode' => 'CSF205', 'nama' => 'Organisasi dan Manajemen', 'sks' => 3, 'semester' => 2],
            ['kode' => 'CIS201', 'nama' => 'Pemodelan Proses Bisnis', 'sks' => 3, 'semester' => 2],
            ['kode' => 'CSF308', 'nama' => 'Pemrograman Berorientasi Objek', 'sks' => 3, 'semester' => 3],
            ['kode' => 'CSF412', 'nama' => 'Pemrograman Web', 'sks' => 3, 'semester' => 4],
            ['kode' => 'UNV114', 'nama' => 'Pendidikan Agama', 'sks' => 2, 'semester' => 1],
            ['kode' => 'CIS514', 'nama' => 'Rekayasa Layanan', 'sks' => 3, 'semester' => 5],
            ['kode' => 'CSF311', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 3],
            ['kode' => 'CSF722', 'nama' => 'Seminar Proposal', 'sks' => 2, 'semester' => 7],
            ['kode' => 'CIS303', 'nama' => 'Sistem Informasi Enterprise', 'sks' => 3, 'semester' => 3],
            ['kode' => 'CSF310', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3],
            ['kode' => 'CSF516', 'nama' => 'Statistik', 'sks' => 3, 'semester' => 5],
            ['kode' => 'CSF204', 'nama' => 'Struktur Data', 'sks' => 3, 'semester' => 2],
            ['kode' => 'CSF823', 'nama' => 'Tugas Akhir', 'sks' => 6, 'semester' => 8],
        ];

        foreach ($data as $item) {
            Course::firstOrCreate(
                ['kode' => $item['kode']],
                ['nama' => $item['nama'], 'sks' => $item['sks'], 'semester' => $item['semester']]
            );
        }
    }
}
