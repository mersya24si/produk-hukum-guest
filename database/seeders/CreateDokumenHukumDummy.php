<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateDokumenHukumDummy extends Seeder
{
    public function run(): void
    {
        $faker             = Faker::create('id_ID');
        $numberOfDocuments = 100;
        $now               = now();

        $jenisIDs    = DB::table('jenisdokumen')->pluck('jenis_id')->toArray();
        $kategoriIDs = DB::table('kategori')->pluck('kategori_id')->toArray();

        if (empty($jenisIDs) || empty($kategoriIDs)) {
            $this->command->warn('Seeder DokumenHukum dilewati karena jenis/kategori kosong.');
            return;
        }

        $topik = [
            'Pengelolaan Anggaran',
            'Izin Usaha Mikro',
            'Pembangunan Infrastruktur Jalan',
            'Pengadaan Lahan Kas Desa',
            'Penetapan Retribusi Sampah',
            'Perlindungan Hak Masyarakat Adat',
            'Pendirian Badan Usaha Milik Desa',
            'Tata Tertib Perangkat Desa',
            'Layanan Administrasi Kependudukan',
        ];

        for ($i = 0; $i < $numberOfDocuments; $i++) {

            $judulTopik = $faker->randomElement($topik) . ' Desa ' . $faker->city();

            // =============================
            // INSERT DOKUMEN & AMBIL ID
            // =============================
            $dokumenId = DB::table('dokumen_hukum')->insertGetId([
                'jenis_id'    => $faker->randomElement($jenisIDs),
                'kategori_id' => $faker->randomElement($kategoriIDs),
                'nomor'       => 'BINA-' . $faker->unique()->numerify('#####') . '/' . date('Y'),
                'judul'       => Str::title($judulTopik),
                'tanggal'     => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'ringkasan'   => 'Ringkasan tentang ' . strtolower($judulTopik) . '. ' . $faker->paragraph(2),
                'status'      => $faker->randomElement(['diterima', 'diproses', 'ditolak']),
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);

            // =============================
            // INSERT MEDIA / LAMPIRAN
            // =============================
            $jumlahLampiran = $faker->numberBetween(1, 3);

            for ($j = 1; $j <= $jumlahLampiran; $j++) {

                $ext  = $faker->randomElement(['pdf', 'docx', 'jpg']);
                $mime = match ($ext) {
                    'pdf'   => 'application/pdf',
                    'docx'  => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    default => 'image/jpeg',
                };

                DB::table('media')->insert([
                    'ref_table' => 'dokumen_hukum',
                    'ref_id'    => $dokumenId,
                    'file_name' => Str::slug($judulTopik) . "-{$j}.{$ext}",
                    'caption' => "Lampiran {$j} untuk {$judulTopik}",
                    'mime_type'  => $mime,
                    'sort_order' => $j,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('100 Dokumen Hukum + Media berhasil dibuat.');
    }
}
