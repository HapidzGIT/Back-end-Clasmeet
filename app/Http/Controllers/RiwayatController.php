<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;

class RiwayatController extends Controller
{
    public function index()
    {

        $riwayats = Riwayat::with(['lomba', 'namaKelas', 'jumlahPemain', 'namaPeserta', 'jurusan'])->get();

        return response()->json([
            'success' => true,
            'data' => $riwayats
        ]);
    }

    public function show($id)
    {
        // Mengambil data riwayat berdasarkan ID beserta relasinya
        $riwayat = Riwayat::with(['lomba', 'namaKelas', 'jumlahPemain', 'namaPeserta', 'jurusan'])->find($id);

        if (!$riwayat) {
            return response()->json([
                'success' => false,
                'message' => 'Data riwayat not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $riwayat
        ]);
    }

    // Metode lain seperti store(), update(), delete() dapat ditambahkan sesuai kebutuhan
}
