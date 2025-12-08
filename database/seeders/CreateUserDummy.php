<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUserDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menggunakan locale Indonesia
        $faker = Factory::create('id_ID');

        // Membuat 30–100 data dummy secara acak
        $jumlahData = rand(30, 100);

        foreach (range(1, $JumlahData) as $index) {
            DB::table('users')->insert([
                'name'     => $faker->name,
                'email'    => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'), // password default
            ]);
        }
    }
}
