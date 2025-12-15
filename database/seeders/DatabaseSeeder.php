<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // =====================
        // USER DEFAULT
        // =====================
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        // =====================
        // DATA MASTER & DUMMY
        // =====================
        $this->call([
            CreateDokumenHukumDummy::class,
            LampiranDokumenSeeder::class,
            RiwayatPerubahanSeeder::class,
        ]);
    }
}
