<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pasien;

class PasienFactory extends Factory
{
    protected $model = Pasien::class;

    public function definition(): array
    {
        return [
            'nama' => 'Agus Setiawan',
            'umur' => 25,
            'alamat' => 'Jl. Merdeka No. 10, Palembang',
            'dokter_id' => 1, // pastikan dokter dengan ID 1 ada di database
        ];
    }
}
