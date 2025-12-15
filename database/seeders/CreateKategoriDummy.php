<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateKategoriDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kategoriList = [
            'Perumahan' => 'Kategori yang berkaitan dengan tata ruang, izin mendirikan bangunan, dan legalitas kepemilikan hunian di desa.',
            'Pertanian' => 'Meliputi dokumen regulasi, izin, atau kebijakan terkait pengelolaan lahan pertanian, irigasi, dan hasil panen.',
            'Perkebunan' => 'Berisi peraturan mengenai pengelolaan komoditas perkebunan, izin HGU skala kecil, dan sertifikasi kebun.',
            'Industri' => 'Dokumen dan kebijakan yang mengatur pendirian dan operasional industri rumahan, UKM, atau industri besar di wilayah desa.',
            'Perdagangan' => 'Kumpulan peraturan terkait izin usaha dagang, pasar desa, dan kegiatan distribusi barang dan jasa.',
            'Fasilitas Umum' => 'Meliputi dokumen perencanaan, pembangunan, dan pengelolaan infrastruktur seperti jalan, sekolah, atau sarana kesehatan publik.',
            'Dokumen Legal' => 'Kategori untuk surat-surat resmi, akta, dan dokumen yang memiliki kekuatan hukum formal di luar kategori spesifik lainnya.',
            'Keuangan' => 'Dokumen yang mengatur tentang anggaran pendapatan dan belanja desa (APBDes), pajak, retribusi, dan pertanggungjawaban keuangan.',
            'Lainnya' => 'Kategori umum untuk dokumen atau produk hukum yang tidak termasuk dalam klasifikasi yang telah ditetapkan.',
        ];

        $dataToInsert = [];

        // Hapus data lama (opsional)
        // DB::table('kategori')->truncate();

        foreach ($kategoriList as $nama => $deskripsiDefault) {
            $deskripsiTambahan = $faker->optional(0.6, '')->sentence(5, true); // Tambahkan kalimat acak 60%

            $dataToInsert[] = [
                'nama' => $nama,
                // Menggunakan deskripsi kontekstual + kalimat acak dari Faker
                'deskripsi' => $deskripsiDefault . ' ' . $deskripsiTambahan,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert massal untuk efisiensi
        DB::table('kategori')->insert($dataToInsert);
    }
}
