<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasien;
use App\Models\Dokter;

class PasienSeeder extends Seeder
{
    public function run()
    {
        // Ambil dokter pertama (misalnya Dr. Andi)
        $dokter = \App\Models\Dokter::first();

        // Masukkan pasien manual
        Pasien::create([
            'nama' => 'Rudi Hartono',
            'umur' => 25,
            'alamat' => 'Palembang',
            'dokter_id' => $dokter->id,
        ]);

        Pasien::create([
            'nama' => 'Sari Lestari',
            'umur' => 32,
            'alamat' => 'Jakarta',
            'dokter_id' => $dokter->id,
        ]);

        Pasien::create([
            'nama' => 'Agus Saputra',
            'umur' => 45,
            'alamat' => 'Bandung',
            'dokter_id' => $dokter->id,
        ]);
    }
}
