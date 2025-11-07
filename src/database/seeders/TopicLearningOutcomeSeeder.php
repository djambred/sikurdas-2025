<?php

namespace Database\Seeders;

use App\Models\TopicLearningOutcome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicLearningOutcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['code' => 'Sub-CPMK1', 'detail' => 'Mampu menjelaskan dan mendefinisikan konsep, ruang lingkup, dan terminologi dasar mata kuliah.'],
            ['code' => 'Sub-CPMK2', 'detail' => 'Mampu mengidentifikasi dan menganalisis permasalahan atau kebutuhan informasi dari studi kasus sederhana.'],
            ['code' => 'Sub-CPMK3', 'detail' => 'Mampu memodelkan dan merumuskan kerangka kerja atau struktur dasar dari solusi yang diusulkan.'],
            ['code' => 'Sub-CPMK4', 'detail' => 'Mampu memodelkan alur kerja, proses, atau hubungan antar komponen dalam sistem menggunakan notasi standar.'],
            ['code' => 'Sub-CPMK5', 'detail' => 'Mampu menerapkan prinsip atau sintaks dasar dalam lingkungan praktikum/penerapan teknis.'],
            ['code' => 'Sub-CPMK6', 'detail' => 'Mampu mengimplementasikan teknik atau algoritma lanjutan untuk memecahkan masalah teknis.'],
            ['code' => 'Sub-CPMK7', 'detail' => 'Mampu mengintegrasikan dua atau lebih komponen teknis dalam lingkungan lokal (end-to-end).'],
            ['code' => 'Sub-CPMK8', 'detail' => 'Mampu merancang dan membuat spesifikasi detail suatu komponen sistem (misalnya UI, database, atau arsitektur).'],
            ['code' => 'Sub-CPMK9', 'detail' => 'Mampu menyusun rencana kerja, estimasi sumber daya, atau alokasi anggaran proyek.'],
            ['code' => 'Sub-CPMK10', 'detail' => 'Mampu mengidentifikasi dan menganalisis risiko atau isu tata kelola yang terkait dengan solusi.'],
            ['code' => 'Sub-CPMK11', 'detail' => 'Mampu menilai dan merekomendasikan peningkatan, inovasi, atau solusi technopreneurship berbasis riset.'],
            ['code' => 'Sub-CPMK12', 'detail' => 'Mampu mengintegrasikan seluruh komponen solusi ke dalam lingkungan operasional yang lengkap.'],
            ['code' => 'Sub-CPMK13', 'detail' => 'Mampu menyajikan dan mengomunikasikan hasil akhir secara profesional dan mempertimbangkan aspek etika/sosial.'],
            ['code' => 'Sub-CPMK14', 'detail' => 'Mampu merefleksikan dan mengevaluasi proses belajar mandiri serta mengidentifikasi area pengembangan diri.'],
        ];

        foreach ($data as $item) {
            TopicLearningOutcome::firstOrCreate(
                ['code' => $item['code']], // cari berdasarkan code
                ['detail' => $item['detail']] // jika belum ada, buat baru
            );
        }
    }
}
