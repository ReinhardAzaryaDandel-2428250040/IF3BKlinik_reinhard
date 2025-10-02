<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokter;

class DokterSeeder extends Seeder
{
    public function run()
    {
        Dokter::create([
            'nama' => 'Dr. Andi Wijaya',
            'spesialis' => 'Umum',
             'no_telp'   => '081298765432',
        ]);

        Dokter::create([
            'nama' => 'Dr. Siti Nurhaliza',
            'spesialis' => 'Anak',
            'no_telp'   => '081234567890',
            
        ]);

        Dokter::create([
            'nama' => 'Dr. Budi Santoso',
            'spesialis' => 'Gigi',
             'no_telp'   => '081277788899',
        ]);
    }
}
