<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemenang;
use App\Models\Lomba;

class PemenangJadwal extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'lomba_id' => 'required',
            'kelas_pemenang' => 'required',
        ]);
    
        // Membuat data pemenang
        $pemenang = Pemenang::create($request->all());
    
        // Mengambil data pemenang berserta relasi lomba
        $pemenang->load('lomba');
    
        return response()->json([
            'nama_lomba' => $pemenang->lomba->buatLomba->nama_lomba ?? null,
            'nama_kelas' => $pemenang->lomba->nama_kelas,
            'jumlah_pemain' => $pemenang->lomba->jumlah_pemain,
            'kelas_pemenang' => $request->kelas_pemenang
        ]);
    }
    
}
