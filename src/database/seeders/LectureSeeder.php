<?php

namespace Database\Seeders;

use App\Models\Lecture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'ACENG SALIM, S.T, M.T'],
            ['name' => 'ADI WIDIANTONO, S.Kom, M.Kom'],
            ['name' => 'AGUNG MULYO WIDODO, ST, M.Sc, Ph.D'],
            ['name' => 'AGUS HERWANTO, ST, M.M'],
            ['name' => 'ANIK HANIFATUL AZIZAH, S.Kom, M.IM'],
            ['name' => 'ARI PAMBUDI, S.Kom, M.Kom'],
            ['name' => 'ARIEF ICHWANI, ST, MT'],
            ['name' => 'ARY PRABOWO, S.Komp., M.Kom.'],
            ['name' => 'ASTRID CHRISAFI, S.S, M.Hum'],
            ['name' => 'AZIFA HABIBA, S.Kom., M.Kom.'],
            ['name' => 'BAMBANG IRAWAN, S.Kom, M.Kom, Ph.D'],
            ['name' => 'BAYU SULISTIYANTO IPUNG SUTEJO, S.Kom., M.Kom'],
            ['name' => 'BINASTYA ANGGARA SEKTI, ST, MM'],
            ['name' => 'DEWI SETIOWATI, A.Md., S.Pd., M.Tr.Kom.'],
            ['name' => 'DIAH ARYANI, ST, M.Kom'],
            ['name' => 'DIANA NOVITA, ST, MM'],
            ['name' => 'Dr. BUDI TJAHJONO, S.Kom, M.Kom'],
            ['name' => 'Dr. GERRY FIRMANSYAH, S.T., M.Kom'],
            ['name' => 'Dr. HANI DEWI ARIESSANTI, S.Kom, M.Kom'],
            ['name' => 'Dr. HASYIM GAUTAMA, ST. M.Sc'],
            ['name' => 'Dr. NENDEN SITI FATONAH, S.Si., M.Kom.'],
            ['name' => 'Dr. RAHMAT BUDIARSA, S.Kom'],
            ['name' => 'Dr. RIYA WIDAYANTI, S.Kom, MMSI.'],
            ['name' => 'Dr. VITRI TUNDJUNGSARI, ST., M.Sc., M.M'],
            ['name' => 'Dr. WINDA SUCI LESTARI NASUTION, S.Pd.I., M.Pd.'],
            ['name' => 'Dra. SRI KLIWATI, M.Kom'],
            ['name' => 'DWI SARTIKA SIMATUPANG, S.T., M.T.I.'],
            ['name' => 'HABIBULLAH AKBAR, S.Si, M.Sc, Ph.D'],
            ['name' => 'HENDRY GUNAWAN, S.Kom,MM'],
            ['name' => 'HERMANSYAH, S.Kom, M.Kom'],
            ['name' => 'IKSAN RAMADHAN, S.Kom, M.Kom'],
            ['name' => 'IMAM SUTANTO, S.Kom, M.Kom'],
            ['name' => 'Ir. ANDRIYANTI ASIANTO, M.Kom'],
            ['name' => 'Ir. NIXON ERZED, MT.'],
            ['name' => 'Ir. NIZIRWAN ANWAR, MT, IPM, ASEAN.Eng., APEC Eng.'],
            ['name' => 'Ir. SAWALI WAHYU, S.Kom, M.Kom'],
            ['name' => 'JEFRY SUNUPURWA ASRI, S.Kom., M.Kom.'],
            ['name' => 'KARTINI, S.Kom, MMSI'],
            ['name' => 'MAIMUN, ST, M.T'],
            ['name' => 'MASMUR TARIGAN, S.T, M.Kom'],
            ['name' => 'MUHAMAD HADI ARFIAN, S.Kom, MM'],
            ['name' => 'MUHAMAD SOBRI, S.SI, M.T'],
            ['name' => 'MUNAWAR, S.TP, MM, Ph.D.'],
            ['name' => 'NUGROHO BUDHISANTOSA, ST. MMSI.'],
            ['name' => 'NYOMAN PUTRA ANTARA, S.Pd.M.Si'],
            ['name' => 'POPONG SETIAWATI, S.Kom.MMSI'],
            ['name' => 'QORI HALIMATUL HIDAYAH, S.Pd., M.Kom.'],
            ['name' => 'RADEN TEDDY ISWAHYUDI, S.T., M.Kom.'],
            ['name' => 'RANNY MEILISA, S.Kom., M.Pd.T.'],
            ['name' => 'RATNA YULIKA GO, S.Kom., M.T.I.'],
            ['name' => 'RYAN PUTRA LAKSANA, S.Kom., M.M.'],
            ['name' => 'SURYANI, S.Si, M.Si'],
            ['name' => 'TAUFIK RENDI ANGGARA, S.Si, M.T.'],
            ['name' => 'THEODORA MARIA PUTRI KOMUL, S.Kom., MM.'],
            ['name' => 'TRI ISMARDIKO WIDYAWAN, S.Kom, M.Kom'],
            ['name' => 'YULHENDRI, ST, M.T'],
            ['name' => 'ALIVIA YULFITRI, S.Si, M.T.'],
            ['name' => 'BADIE UDDIN, S.T., S.Kom., M.Kom'],
            ['name' => 'MALABAY, S.Kom, M.Kom'],
            ['name' => 'ANANDA PUTRIANI, S.Pd., M.Pd.'],
            ['name' => 'INDRIANI NOOR HAPSARI, ST, MT'],
            ['name' => 'MUHAMAD BAHRUL ULUM, S.Kom, M.Kom, S. Kom'],
            ['name' => 'NOVIANDI, S.Kom, M.Kom'],
            ['name' => 'SANDFRENI, S.SI, M.T'],
            ['name' => 'SILVIA RATNA JUWITA, S.Pd, M.Pd'],
        ];

        foreach ($data as $dosen) {
            Lecture::firstOrCreate(['name' => $dosen['name']]);
        }
    }
}
