<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory; // ✅ harus ada ini

    protected $fillable = [
        'nama',
        'spesialis',
        'no_telp',
    ];

    // Relasi ke Pasien
    public function pasiens()
    {
        return $this->hasMany(Pasien::class);
    }
}

