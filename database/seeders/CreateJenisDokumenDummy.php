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
         $faker = Faker::create('id_ID');

        for ($i = 0; $i < 20; $i++) {
            DB::table('jenisdokumen')->insert([
                'nama_jenis' => $faker->randomElement([
                    'Sertifikat Hak Milik',
                    'Akta Jual Beli',
                    'Surat Keterangan Tanah',
                    'Girik',
                    'SPPT PBB',
                    'IMB (Izin Mendirikan Bangunan)',
                    'Surat Waris',
                    'Perjanjian Sewa',
                    'Dokumen Kepemilikan Lain'
                ]),
                'deskripsi' => $faker->sentence(10),
            ]);
        }
    }
}
