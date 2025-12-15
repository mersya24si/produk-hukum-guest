<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateLampiranDokumenDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $now = now();

        // ambil semua dokumen hukum yang ada
        $dokumenIDs = DB::table('dokumen_hukum')->pluck('dokumen_id')->toArray();

        if (empty($dokumenIDs)) {
            $this->command->warn('Seeder LampiranDokumen dilewati karena dokumen_hukum kosong.');
            return;
        }

        foreach ($dokumenIDs as $dokumenId) {

            // setiap dokumen punya 1–3 lampiran_dokumen
            $jumlahLampiran = $faker->numberBetween(1, 3);

            for ($i = 1; $i <= $jumlahLampiran; $i++) {

                // =========================
                // INSERT LAMPIRAN_DOKUMEN
                // =========================
                $lampiranId = DB::table('lampiran_dokumen')->insertGetId([
                    'dokumen_id' => $dokumenId,
                    'keterangan' => 'Lampiran ke-' . $i . ' berupa ' . $faker->randomElement([
                        'dokumen pendukung',
                        'berkas administrasi',
                        'hasil verifikasi',
                        'surat pendukung',
                        'dokumen resmi',
                    ]),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // =========================
                // INSERT MEDIA (ATTACHMENTS)
                // =========================
                $jumlahMedia = $faker->numberBetween(1, 2);

                for ($j = 1; $j <= $jumlahMedia; $j++) {

                    $ext = $faker->randomElement(['pdf', 'docx', 'jpg']);
                    $mime = match ($ext) {
                        'pdf'  => 'application/pdf',
                        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        default => 'image/jpeg',
                    };

                    DB::table('media')->insert([
                        'ref_table'  => 'lampiran_dokumen',
                        'ref_id'     => $lampiranId,
                        'file_name'  => "lampiran-{$lampiranId}-{$j}.{$ext}",
                        'caption'    => "File lampiran {$j}",
                        'mime_type'  => $mime,
                        'sort_order' => $j,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        }

        $this->command->info('Lampiran Dokumen + Media berhasil dibuat.');
    }
}
