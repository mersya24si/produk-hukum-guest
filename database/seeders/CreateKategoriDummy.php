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
        //
         $faker = Faker::create('id_ID');

        $kategoriList = [
            'Perumahan',
            'Pertanian',
            'Perkebunan',
            'Industri',
            'Perdagangan',
            'Fasilitas Umum',
            'Dokumen Legal',
            'Keuangan',
            'Lainnya'
        ];

        foreach ($kategoriList as $kategori) {
            DB::table('kategori')->insert([
                'nama' => $kategori,
                'deskripsi' => $faker->sentence(12),
            ]);
        }
    }
}
