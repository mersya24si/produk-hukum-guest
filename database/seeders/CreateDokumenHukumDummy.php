<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateDokumenHukumDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
          $faker = Faker::create('id_ID');

        // Ambil semua ID dari tabel relasi
        $jenisIDs = DB::table('jenisdokumen')->pluck('jenis_id')->toArray();
        $kategoriIDs = DB::table('kategori')->pluck('kategori_id')->toArray();

        // Jika data relasi kosong → hindari error
        if (empty($jenisIDs) || empty($kategoriIDs)) {
            return;
        }

        for ($i = 0; $i < 100; $i++) {
            DB::table('dokumen_hukum')->insert([
                'jenis_id'      => $faker->randomElement($jenisIDs),
                'kategori_id'   => $faker->randomElement($kategoriIDs),
                'nomor'         => strtoupper('DOC-' . $faker->unique()->numerify('#####')),
                'judul'         => $faker->sentence(6),
                'tanggal'       => $faker->date(),
                'ringkasan'     => $faker->paragraph(3),
                'status'        => $faker->randomElement(['Ditolak', 'Diproses', 'Diterima']),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
