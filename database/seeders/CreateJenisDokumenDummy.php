<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateJenisDokumenDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tetapkan locale Indonesia
        $faker = Faker::create('id_ID');

        // DAFTAR JENIS DOKUMEN HUKUM YANG UMUM DI INDONESIA (Tingkat Desa/Pemerintahan)
        $jenisDokumenHukum = [
            'Peraturan Desa (Perdes)',
            'Peraturan Kepala Desa (Perkades)',
            'Keputusan Kepala Desa (Kepkades)',
            'Surat Keputusan (SK)',
            'Surat Edaran',
            'Surat Keterangan',
            'Nota Kesepahaman (MoU)',
            'Berita Acara',
            'Rancangan Peraturan Desa',
            'Dokumen Perencanaan (RPJMDes/RKPDes)',
        ];

        $dataToInsert = [];

        // Hapus data lama (opsional, untuk memastikan seeder bersih)
        // DB::table('jenisdokumen')->truncate();

        foreach ($jenisDokumenHukum as $jenis) {
            $dataToInsert[] = [
                'nama_jenis' => $jenis,
                // Menggunakan Faker untuk deskripsi dalam Bahasa Indonesia
                'deskripsi' => 'Dokumen resmi yang berisi ' . $faker->randomElement(['penetapan', 'ketetapan', 'perencanaan', 'pengumuman']) . ' tentang ' . $faker->sentence(4, true) . '.',
                // Tambahkan timestamps jika ada
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Jika Anda tetap ingin 100 data dummy, Anda bisa melakukan perulangan tambahan:
        for ($i = count($dataToInsert); $i < 100; $i++) {
            $dataToInsert[] = [
                'nama_jenis' => 'Jenis Dokumen Lain ' . ($i + 1),
                'deskripsi' => $faker->sentence(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }


        // Insert massal untuk efisiensi
        DB::table('jenisdokumen')->insert($dataToInsert);
    }
}
