<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Matikan sementara foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus data lama
        Pasien::truncate();
        Dokter::truncate();
        User::truncate();

        // Aktifkan kembali foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Buat user default
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Jalankan seeder lain
        $this->call([
            DokterSeeder::class,
            PasienSeeder::class,
        ]);
    }
}
