<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Tampilkan semua dokter
     */
    public function index()
    {
        $dokters = Dokter::all();
        return response()->json([
            'Success' => true,
            'Message' => 'List semua dokter',
            'Data'    => $dokters
        ], 200);
    }

    /**
     * Tampilkan satu dokter beserta pasien
     */
    public function show($id)
    {
        $dokter = Dokter::with('pasiens')->find($id);

        if ($dokter) {
            return response()->json([
                'Success' => true,
                'Message' => 'Detail dokter ditemukan',
                'Data'    => $dokter
            ], 200);
        } else {
            return response()->json([
                'Success' => false,
                'Message' => 'Dokter tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Simpan dokter baru
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama'      => 'required|string',
            'spesialis' => 'required|string',
            'no_telp'   => 'required|string',
        ]);

        $dokter = Dokter::create($validate);

        if ($dokter) {
            return response()->json([
                'Success' => true,
                'Message' => 'Data Dokter Berhasil Disimpan',
                'Data'    => $dokter
            ], 201);
        }
    }

    /**
     * Update dokter
     */
    public function update(Request $request, $id)
    {
        $dokter = Dokter::find($id);

        if ($dokter) {
            $validate = $request->validate([
                'nama'      => 'sometimes|string',
                'spesialis' => 'sometimes|string',
                'no_telp'   => 'sometimes|string',
            ]);

            $dokter->update($validate);

            return response()->json([
                'Success' => true,
                'Message' => 'Data Dokter Berhasil Diupdate',
                'Data'    => $dokter
            ], 200);
        } else {
            return response()->json([
                'Success' => false,
                'Message' => 'Dokter tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Hapus dokter
     */
    public function destroy($id)
    {
        $dokter = Dokter::find($id);

        if ($dokter) {
            $dokter->delete();
            return response()->json([
                'Success' => true,
                'Message' => 'Data Dokter Berhasil Dihapus'
            ], 200);
        } else {
            return response()->json([
                'Success' => false,
                'Message' => 'Dokter tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Tampilkan semua dokter beserta pasien (relasi one-to-many)
     */
    public function indexWithPasiens()
    {
        $dokters = Dokter::with('pasiens')->get();
        return response()->json([
            'Success' => true,
            'Message' => 'List dokter beserta pasien',
            'Data'    => $dokters
        ], 200);
    }
}
