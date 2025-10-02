<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Dokter;

class DokterFactory extends Factory
{
    protected $model = Dokter::class;

    public function definition(): array
    {
        // Data manual dokter pertama
        return [
            'nama' => 'Dr. Andi Wijaya',
            'spesialis' => 'Umum',
            'no_telp' => '081234567890',
        ];
    }
}
