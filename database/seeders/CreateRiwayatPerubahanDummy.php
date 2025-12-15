<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateRiwayatPerubahanDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $now = now();

        // ambil semua dokumen hukum
        $dokumenIDs = DB::table('dokumen_hukum')->pluck('dokumen_id')->toArray();

        if (empty($dokumenIDs)) {
            $this->command->warn('Seeder RiwayatPerubahan dilewati karena dokumen_hukum kosong.');
            return;
        }

        foreach ($dokumenIDs as $dokumenId) {

            // setiap dokumen punya 1–4 riwayat perubahan
            $jumlahRiwayat = $faker->numberBetween(1, 4);
            $versi = 1;

            for ($i = 1; $i <= $jumlahRiwayat; $i++) {

                DB::table('riwayat_perubahan')->insert([
                    'dokumen_id'        => $dokumenId,
                    'tanggal'           => $faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
                    'uraian_perubahan'  => $faker->randomElement([
                        'Perubahan redaksi pasal',
                        'Penyesuaian dasar hukum',
                        'Perubahan lampiran',
                        'Pembaruan substansi ketentuan',
                        'Perbaikan kesalahan penulisan',
                    ]),
                    'versi'             => 'v' . $versi++,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ]);
            }
        }

        $this->command->info('Riwayat Perubahan Dokumen berhasil dibuat.');
    }
}
