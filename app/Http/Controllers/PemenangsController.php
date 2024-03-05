<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pemenangs;
use App\Models\JadwalLomba;
use Illuminate\Http\Request;

class PemenangsController extends Controller
{
    public function create(Request $request)
    {
        // Validasi input
        $request->validate([
            'kelas_pemenang' => 'required|string',
            'jadwal_lomba_id' => 'required|exists:jadwal_lomba,id'
        ]);
    
        // Membuat data pemenang
        $pemenang = Pemenangs::create([
            'kelas_pemenang' => $request->kelas_pemenang,
            'jadwal_lomba_id' => $request->jadwal_lomba_id
        ]);
    
        // Mengambil data lomba berdasarkan jadwal_lomba_id
        $jadwalLomba = Jadwal::findOrFail($request->jadwal_lomba_id);
    
        // Mengembalikan respons JSON dengan data yang diminta
        return response()->json([
            'nama_lomba' => $jadwalLomba->nama_lomba,
            'tanggal' => $jadwalLomba->tanggal,
            'waktu' => $jadwalLomba->waktu,
            'kelas' => $jadwalLomba->kelas,
            'tempat' => $jadwalLomba->tempat,
            // 'keterangan' => $jadwalLomba->keterangan,
            'kelas_pemenang' => $request->kelas_pemenang
        ], 201);
    }
    public function getJadwalLomba($id)
    {
        $pemenang = Pemenangs::findOrFail($id);
        $jadwalLomba = $pemenang->jadwalLomba;

        return response()->json($jadwalLomba, 200);
    }

    public function getAllJadwalLomba()
    {
        $jadwalLomba = Jadwal::all();

        return response()->json($jadwalLomba, 200);
    }
}
