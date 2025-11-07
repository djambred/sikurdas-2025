<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Course::truncate();
        Category::truncate();
        DB::table('course_prerequisites')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Buat kategori
        $wajib = Category::create(['name' => 'Wajib']);
        $pilihan = Category::create(['name' => 'Pilihan']);

        // --- DATA MATA KULIAH MAJOR 1 ---
        $courses_major1 = [
            ['kode' => 'UNV112', 'nama' => 'Pendidikan Agama I', 'sks' => 2, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'UNV122', 'nama' => 'Pendidikan Pancasila', 'sks' => 2, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF101', 'nama' => 'Algoritma dan Pemrograman', 'sks' => 3, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF102', 'nama' => 'Sistem dan Teknologi Informasi', 'sks' => 3, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF103', 'nama' => 'Matematika Diskrit', 'sks' => 3, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF104', 'nama' => 'Aljabar Linear', 'sks' => 3, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'LEU101', 'nama' => 'Bahasa Inggris I', 'sks' => 2, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'UNV212', 'nama' => 'Bahasa Indonesia', 'sks' => 2, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF201', 'nama' => 'Analisis dan Perancangan Sistem Informasi', 'sks' => 3, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF202', 'nama' => 'Pemrograman Berorientasi Objek', 'sks' => 3, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF203', 'nama' => 'Arsitektur dan Organisasi Komputer', 'sks' => 3, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF204', 'nama' => 'Statistika', 'sks' => 3, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF205', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF206', 'nama' => 'Logika dan Algoritma Lanjut', 'sks' => 3, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF301', 'nama' => 'Sistem Basis Data', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF302', 'nama' => 'Manajemen Basis Data', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF303', 'nama' => 'Pemrograman Web', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF304', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF305', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'UNV321', 'nama' => 'Pendidikan Kewarganegaraan', 'sks' => 2, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF401', 'nama' => 'Rekayasa Sistem Informasi', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF402', 'nama' => 'Sistem Pendukung Keputusan', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF403', 'nama' => 'Pemrograman Mobile', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF404', 'nama' => 'Analisis Perancangan Jaringan', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF405', 'nama' => 'Audit Sistem Informasi', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF406', 'nama' => 'Keamanan Sistem Informasi', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF407', 'nama' => 'Data Mining', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF501', 'nama' => 'Interaksi Manusia dan Komputer', 'sks' => 3, 'semester' => 5, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF502', 'nama' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 5, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF503', 'nama' => 'Proyek Sistem Informasi', 'sks' => 3, 'semester' => 5, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF504', 'nama' => 'Etika Profesi dan IT Governance', 'sks' => 3, 'semester' => 5, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF505', 'nama' => 'Sistem Enterprise', 'sks' => 3, 'semester' => 5, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF506', 'nama' => 'Rekayasa Data', 'sks' => 3, 'semester' => 5, 'category_id' => $pilihan->id, 'major_id' => 1],
            ['kode' => 'CSF507', 'nama' => 'Sistem Terdistribusi', 'sks' => 3, 'semester' => 5, 'category_id' => $pilihan->id, 'major_id' => 1],
            ['kode' => 'CSF508', 'nama' => 'Data Warehouse', 'sks' => 3, 'semester' => 5, 'category_id' => $pilihan->id, 'major_id' => 1],
            ['kode' => 'CSF601', 'nama' => 'Sistem Informasi Geografis', 'sks' => 3, 'semester' => 6, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF602', 'nama' => 'Sistem Informasi Kesehatan', 'sks' => 3, 'semester' => 6, 'category_id' => $pilihan->id, 'major_id' => 1],
            ['kode' => 'CSF603', 'nama' => 'Sistem Informasi Akuntansi', 'sks' => 3, 'semester' => 6, 'category_id' => $pilihan->id, 'major_id' => 1],
            ['kode' => 'CSF604', 'nama' => 'Sistem Informasi Manufaktur', 'sks' => 3, 'semester' => 6, 'category_id' => $pilihan->id, 'major_id' => 1],
            ['kode' => 'CSF605', 'nama' => 'Analitik Bisnis', 'sks' => 3, 'semester' => 6, 'category_id' => $pilihan->id, 'major_id' => 1],
            ['kode' => 'CSF701', 'nama' => 'Seminar Proposal', 'sks' => 2, 'semester' => 7, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF702', 'nama' => 'Manajemen Proyek TI', 'sks' => 3, 'semester' => 7, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF703', 'nama' => 'Praktik Kerja Lapangan', 'sks' => 3, 'semester' => 7, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF704', 'nama' => 'Metodologi Penelitian', 'sks' => 3, 'semester' => 7, 'category_id' => $wajib->id, 'major_id' => 1],
            ['kode' => 'CSF705', 'nama' => 'Inovasi dan Kewirausahaan', 'sks' => 3, 'semester' => 7, 'category_id' => $pilihan->id, 'major_id' => 1],
            ['kode' => 'CSF706', 'nama' => 'Business Intelligence', 'sks' => 3, 'semester' => 7, 'category_id' => $pilihan->id, 'major_id' => 1],
            ['kode' => 'CSF801', 'nama' => 'Skripsi / Tugas Akhir', 'sks' => 6, 'semester' => 8, 'category_id' => $wajib->id, 'major_id' => 1],
        ];

        // --- DATA MATA KULIAH MAJOR 2 ---
        $courses_major2 = [
            // Semester 1
            ['kode' => 'UNV114', 'nama' => 'Pendidikan Agama', 'sks' => 2, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'UNV121', 'nama' => 'Pendidikan Pancasila', 'sks' => 2, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF101', 'nama' => 'Algoritma dan Pemrograman', 'sks' => 3, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF102', 'nama' => 'Dasar Sistem Informasi', 'sks' => 3, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF103', 'nama' => 'Aljabar Linier dan Matriks', 'sks' => 3, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF207', 'nama' => 'Matematika Diskrit', 'sks' => 3, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'UEU101', 'nama' => 'Bahasa Inggris 1', 'sks' => 3, 'semester' => 1, 'category_id' => $wajib->id, 'major_id' => 2],

            // Semester 2
            ['kode' => 'UNV111', 'nama' => 'Bahasa Indonesia', 'sks' => 2, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'UNV113', 'nama' => 'Pendidikan Kewarganegaraan', 'sks' => 2, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIE201', 'nama' => 'Pemodelan Proses Bisnis', 'sks' => 3, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIE202', 'nama' => 'Analisis Kebutuhan Informasi', 'sks' => 3, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF204', 'nama' => 'Struktur Data', 'sks' => 3, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF205', 'nama' => 'Organisasi dan Manajemen', 'sks' => 3, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF206', 'nama' => 'Organisasi dan Arsitektur Komputer', 'sks' => 3, 'semester' => 2, 'category_id' => $wajib->id, 'major_id' => 2],

            // Semester 3
            ['kode' => 'CIS303', 'nama' => 'Sistem Informasi Enterprise', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIS304', 'nama' => 'Manajemen Sumber Daya Informasi', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF308', 'nama' => 'Pemrograman Berorientasi Objek', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF309', 'nama' => 'Basis Data', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF310', 'nama' => 'Sistem Operasi', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF311', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'UNV211', 'nama' => 'Kewirausahaan 1', 'sks' => 3, 'semester' => 3, 'category_id' => $wajib->id, 'major_id' => 2],

            // Semester 4
            ['kode' => 'CIS405', 'nama' => 'Metode Sampling dan Survei SI', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIS406', 'nama' => 'Manajemen Proyek Sistem Informasi', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIS407', 'nama' => 'Integrasi dan Kustomisasi ERP', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF412', 'nama' => 'Pemrograman Web', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF413', 'nama' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF414', 'nama' => 'Analisis dan Perancangan SI', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF415', 'nama' => 'Data Warehouse', 'sks' => 3, 'semester' => 4, 'category_id' => $wajib->id, 'major_id' => 2],

            // Pilihan Semester 4
            ['kode' => 'CIE408', 'nama' => 'Machine Learning', 'sks' => 3, 'semester' => 4, 'category_id' => $pilihan->id, 'major_id' => 2],
            ['kode' => 'CIE409', 'nama' => 'Arsitektur Berbasis Layanan', 'sks' => 3, 'semester' => 4, 'category_id' => $pilihan->id, 'major_id' => 2],
            ['kode' => 'CIE410', 'nama' => 'Internet of Things', 'sks' => 3, 'semester' => 4, 'category_id' => $pilihan->id, 'major_id' => 2],

            // Semester 5
            ['kode' => 'CIS508', 'nama' => 'Infrastruktur dan Manajemen Layanan TI', 'sks' => 3, 'semester' => 5, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIS509', 'nama' => 'E-Bisnis', 'sks' => 3, 'semester' => 5, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIS510', 'nama' => 'Audit dan Kendali Sistem Informasi', 'sks' => 3, 'semester' => 5, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIS511', 'nama' => 'Arsitektur Enterprise', 'sks' => 3, 'semester' => 5, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIS512', 'nama' => 'Analisis Resiko Sistem Informasi', 'sks' => 3, 'semester' => 5, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF516', 'nama' => 'Statistik', 'sks' => 3, 'semester' => 5, 'category_id' => $wajib->id, 'major_id' => 2],

            // Pilihan Semester 5
            ['kode' => 'CIE513', 'nama' => 'Implementasi Sistem Informasi', 'sks' => 3, 'semester' => 5, 'category_id' => $pilihan->id, 'major_id' => 2],
            ['kode' => 'CIE514', 'nama' => 'Rekayasa Layanan', 'sks' => 3, 'semester' => 5, 'category_id' => $pilihan->id, 'major_id' => 2],
            ['kode' => 'CSF517', 'nama' => 'Data Mining', 'sks' => 3, 'semester' => 5, 'category_id' => $pilihan->id, 'major_id' => 2],

            // Semester 6
            ['kode' => 'CIE615', 'nama' => 'Isu Sosial dan Keprofesian SI', 'sks' => 3, 'semester' => 6, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIE616', 'nama' => 'Evaluasi Sistem Informasi', 'sks' => 3, 'semester' => 6, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF617', 'nama' => 'Metodologi Penelitian', 'sks' => 3, 'semester' => 6, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CSF618', 'nama' => 'Interaksi Manusia Komputer', 'sks' => 3, 'semester' => 6, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'UNV321', 'nama' => 'Bahasa Inggris 2', 'sks' => 3, 'semester' => 6, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'UNV322', 'nama' => 'Kewirausahaan 2', 'sks' => 3, 'semester' => 6, 'category_id' => $wajib->id, 'major_id' => 2],

            // Pilihan Semester 6
            ['kode' => 'CIE619', 'nama' => 'Jaminan dan Keamanan Informasi', 'sks' => 3, 'semester' => 6, 'category_id' => $pilihan->id, 'major_id' => 2],
            ['kode' => 'CIE620', 'nama' => 'Masyarakat Virtual', 'sks' => 3, 'semester' => 6, 'category_id' => $pilihan->id, 'major_id' => 2],
            ['kode' => 'CSF621', 'nama' => 'Big Data', 'sks' => 3, 'semester' => 6, 'category_id' => $pilihan->id, 'major_id' => 2],

            // Semester 7
            ['kode' => 'CSF722', 'nama' => 'Seminar Proposal', 'sks' => 2, 'semester' => 7, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIE720', 'nama' => 'Manajemen Pengetahuan', 'sks' => 3, 'semester' => 7, 'category_id' => $wajib->id, 'major_id' => 2],
            ['kode' => 'CIE721', 'nama' => 'Kapita Selekta Sistem Informasi', 'sks' => 3, 'semester' => 7, 'category_id' => $wajib->id, 'major_id' => 2],

            // Pilihan Semester 7
            ['kode' => 'CIE722', 'nama' => 'IT untuk Pemulihan Bencana', 'sks' => 3, 'semester' => 7, 'category_id' => $pilihan->id, 'major_id' => 2],
            ['kode' => 'CIE723', 'nama' => 'Intelegensia Bisnis', 'sks' => 3, 'semester' => 7, 'category_id' => $pilihan->id, 'major_id' => 2],
            ['kode' => 'UNV411', 'nama' => 'Bahasa Inggris 3', 'sks' => 3, 'semester' => 7, 'category_id' => $pilihan->id, 'major_id' => 2],
            ['kode' => 'UNV412', 'nama' => 'Kewirausahaan 3', 'sks' => 3, 'semester' => 7, 'category_id' => $pilihan->id, 'major_id' => 2],

            // Semester 8
            ['kode' => 'CSF823', 'nama' => 'Tugas Akhir', 'sks' => 6, 'semester' => 8, 'category_id' => $wajib->id, 'major_id' => 2],
        ];

        // Daftar kode mata kuliah Major 2 yang berbenturan dengan Major 1
        $clashing_codes = ['CSF101', 'CSF102', 'CSF103', 'CSF204', 'CSF205', 'CSF206', 'UNV321'];
        $code_map = [];

        // 1. Ubah kode pada Major 2 agar unik di database (tambahkan -M2)
        foreach ($courses_major2 as &$course) {
            if (in_array($course['kode'], $clashing_codes)) {
                $original_kode = $course['kode'];
                $new_kode = $original_kode . '-M2';
                // Buat mapping untuk update prasyarat
                $code_map[$original_kode] = $new_kode;
                $course['kode'] = $new_kode;
            }
        }
        unset($course); // Hapus referensi

        // 2. Gabungkan data mata kuliah yang sudah dijamin unik
        $all_courses_data = array_merge($courses_major1, $courses_major2);

        // 3. Insert semua mata kuliah
        foreach ($all_courses_data as $data) {
            Course::create($data);
        }

        // --- MAPPING PRASYARAT MAJOR 1 (Lengkap) ---
        $prerequisites_major1 = [
            // WAJIB
            'CSF201' => ['CSF102'], 'CSF202' => ['CSF101'], 'CSF203' => ['CSF101'],
            'CSF205' => ['CSF203'], 'CSF301' => ['CSF101', 'CSF204'], 'CSF302' => ['CSF301'],
            'CSF303' => ['CSF202'], 'CSF304' => ['CSF203'], 'CSF305' => ['CSF201'],
            'CSF401' => ['CSF305'], 'CSF402' => ['CSF301'], 'CSF403' => ['CSF303'],
            'CSF404' => ['CSF304'], 'CSF405' => ['CSF305'], 'CSF406' => ['CSF304'],
            'CSF407' => ['CSF301'], 'CSF502' => ['CSF407'], 'CSF503' => ['CSF401'],
            'CSF504' => ['CSF405'], 'CSF505' => ['CSF401'], 'CSF601' => ['CSF401'],
            'CSF701' => ['CSF503'], 'CSF703' => ['CSF503'], 'CSF704' => ['CSF504'],
            'CSF801' => ['CSF701', 'CSF704'],

            // PILIHAN
            'CSF506' => ['CSF301'], 'CSF507' => ['CSF304'], 'CSF508' => ['CSF301'],
            'CSF602' => ['CSF401'], 'CSF603' => ['CSF401'], 'CSF604' => ['CSF401'],
            'CSF605' => ['CSF407'], 'CSF705' => ['CSF503'], 'CSF706' => ['CSF407'],
        ];

        // --- MAPPING PRASYARAT MAJOR 2 (Termasuk Asumsi untuk Pilihan Teknis) ---
        $prerequisites_major2 = [
            // Wajib (sama seperti sebelumnya)
            'CIE201' => ['CSF102'],
            'CIE202' => ['CSF102'],
            'CSF204' => ['CSF101'],
            'CSF308' => ['CSF101'],
            'CSF309' => ['CSF102'],
            'CSF310' => ['CSF206'],
            'CSF311' => ['CIE202'],
            'CSF414' => ['CSF311', 'CIE201'],
            'CSF412' => ['CSF308'],
            'CSF413' => ['CSF206'],
            'CSF415' => ['CSF309'],
            'CIS406' => ['CSF414'],
            'CSF722' => ['CSF617'],
            'CSF823' => ['CSF722'],

            // PILIHAN (semua punya syarat)
            'CIE408' => ['CSF516'], // Machine Learning → Statistik
            'CIE409' => ['CSF414'], // SOA → Analisis & Perancangan SI
            'CIE410' => ['CSF413'], // IoT → Jaringan Komputer

            'CIE513' => ['CSF414'], // Implementasi SI → Analisis & Perancangan SI
            'CIE514' => ['CIS406'], // Rekayasa Layanan → Manajemen Proyek SI
            'CSF517' => ['CSF309', 'CSF516'], // Data Mining → Basis Data + Statistik

            'CIE619' => ['CSF413'], // Keamanan Informasi → Jaringan Komputer
            'CIE620' => ['CIE201'], // Masyarakat Virtual → Pemodelan Proses Bisnis
            'CSF621' => ['CSF415'], // Big Data → Data Warehouse

            'CIE722' => ['CIS508'], // IT untuk Pemulihan Bencana → Infrastruktur TI
            'CIE723' => ['CSF415'], // Intelegensia Bisnis → Data Warehouse
            'UNV411' => ['UNV321'], // Bahasa Inggris 3 → Bahasa Inggris 2
            'UNV412' => ['UNV322'], // Kewirausahaan 3 → Kewirausahaan 2
        ];

        // 4. Update kode prasyarat Major 2 menggunakan mapping baru
        $prerequisites_major2_modified = [];
        foreach ($prerequisites_major2 as $kode => $reqs) {
            // Map kode mata kuliah utama (key)
            $new_kode = $code_map[$kode] ?? $kode;

            // Map kode prasyarat (values)
            $new_reqs = array_map(function($req) use ($code_map) {
                return $code_map[$req] ?? $req;
            }, $reqs);

            $prerequisites_major2_modified[$new_kode] = $new_reqs;
        }


        // Fungsi pembantu untuk memasukkan prasyarat berdasarkan Major ID
        $insertPrerequisites = function (array $prerequisites, int $majorId) {
            foreach ($prerequisites as $kode => $reqs) {
                // Cari mata kuliah tujuan (course) berdasarkan kode DAN major_id
                // Di sini kita mencari berdasarkan kode yang sudah dimodifikasi di database
                $course = Course::where('kode', $kode)->where('major_id', $majorId)->first();

                if ($course) {
                    foreach ($reqs as $reqKode) {
                        // Cari mata kuliah prasyarat (prerequisite) berdasarkan kode DAN major_id
                        // Kode prasyarat juga sudah disesuaikan dengan mapping jika itu Major 2
                        $prasyarat = Course::where('kode', $reqKode)->where('major_id', $majorId)->first();

                        if ($prasyarat) {
                            DB::table('course_prerequisites')->insert([
                                'course_id' => $course->id,
                                'prerequisite_id' => $prasyarat->id,
                            ]);
                        }
                    }
                }
            }
        };

        // Jalankan mapping untuk Major 1
        $insertPrerequisites($prerequisites_major1, 1);

        // Jalankan mapping untuk Major 2
        $insertPrerequisites($prerequisites_major2_modified, 2);
    }
}
