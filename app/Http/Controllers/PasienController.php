<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Tampilkan semua pasien beserta dokter
     */
    public function index()
    {
        $pasiens = Pasien::with('dokter')->get();
        return response()->json([
            'Success' => true,
            'Message' => 'List semua pasien beserta dokter',
            'Data'    => $pasiens
        ], 200);
    }

    /**
     * Tampilkan satu pasien beserta dokter
     */
    public function show(string $id)
    {
        $pasien = Pasien::with('dokter')->find($id);

        if ($pasien) {
            return response()->json([
                'Success' => true,
                'Message' => 'Detail pasien ditemukan',
                'Data'    => $pasien
            ], 200);
        } else {
            return response()->json([
                'Success' => false,
                'Message' => 'Pasien tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Simpan pasien baru
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama'      => 'required|string',
            'umur'      => 'required|integer',
            'alamat'    => 'required|string',
            'dokter_id' => 'required|exists:dokters,id'
        ]);

        $pasien = Pasien::create($validate);

        if ($pasien) {
            return response()->json([
                'Success' => true,
                'Message' => 'Data Pasien Berhasil Disimpan',
                'Data'    => $pasien
            ], 201);
        }
    }

    /**
     * Update pasien
     */
    public function update(Request $request, string $id)
    {
        $pasien = Pasien::find($id);

        if ($pasien) {
            $validate = $request->validate([
                'nama'      => 'sometimes|string',
                'umur'      => 'sometimes|integer',
                'alamat'    => 'sometimes|string',
                'dokter_id' => 'sometimes|exists:dokters,id'
            ]);

            $pasien->update($validate);

            return response()->json([
                'Success' => true,
                'Message' => 'Data Pasien Berhasil Diupdate',
                'Data'    => $pasien
            ], 200);
        } else {
            return response()->json([
                'Success' => false,
                'Message' => 'Pasien tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Hapus pasien
     */
    public function destroy(string $id)
    {
        $pasien = Pasien::find($id);

        if ($pasien) {
            $pasien->delete();
            return response()->json([
                'Success' => true,
                'Message' => 'Data Pasien Berhasil Dihapus'
            ], 200);
        } else {
            return response()->json([
                'Success' => false,
                'Message' => 'Pasien tidak ditemukan'
            ], 404);
        }
    }
}
