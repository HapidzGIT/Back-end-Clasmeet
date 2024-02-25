<?php

namespace App\Http\Controllers;

use App\Models\buat_lomba;
use Illuminate\Http\Request;
use App\Models\Lomba;

class LombaController extends Controller
{
    public function create(Request $request)
    {
        // Validasi request jika diperlukan
    
        $lomba = new Lomba();
    
        // Mendapatkan ID lomba yang baru saja dibuat
        $buatLombaId = $request->input('buat_lomba_id');
        
        $lomba->nama_kelas = $request->input('nama_kelas');
        $lomba->jumlah_pemain = $request->input('jumlah_pemain');
        $lomba->nama_peserta = $request->input('nama_peserta');
        $lomba->jurusan = $request->input('jurusan');
        $lomba->kontak = $request->input('kontak');
        $lomba->buat_lomba_id = $buatLombaId;
    
        // Simpan data Lomba
        $lomba->save();
    
        $buatLombaId = $request->input('buat_lomba_id');
        $namaLomba = Lomba::findOrFail($buatLombaId)->buatLomba->nama_lomba;
    
        return response()->json([
            'message' => 'Data Lomba berhasil disimpan',
            'data' => $lomba,
            'nama_lomba' => $namaLomba,
        ], 201);
    }
    


    public function show()
    {
        $lomba = Lomba::paginate(5); 
        return response()->json($lomba);
    }

    public function showId($id)
    {
        $lomba = Lomba::find($id);
        return response()->json($lomba);
    }

    public function update(Request $request, $id)
    {
    $lomba = Lomba::findOrFail($id);
    $lomba->nama_lomba = $request->input('nama_lomba');
    $lomba->nama_kelas = $request->input('nama_kelas');
    $lomba->jumlah_pemain = $request->input('jumlah_pemain');
    $lomba->nama_peserta = $request->input('nama_peserta');
    $lomba->jurusan = $request->input('jurusan');
    $lomba->kontak = $request->input('kontak');

    $lomba->save();
    return response()->json($lomba);
    }

    public function destroy($id)
{
    $lomba = Lomba::find($id);

    if (!$lomba) {
        return response()->json(['message' => 'Not Found'], 404);
    }

    $lomba->delete();

    return response()->json(['message' => 'Resource deleted successfully']);
}
}



// public function update(Request $request, Lomba $lomba)
// {
//     $request->validate([
//         'nama_lomba' => 'required',
//         'nama_kelas' => 'required',
//         'jumlah_pemain' => 'required|integer',
//         'nama_peserta' => 'required',
//         'jurusan' => 'required',
//         'kontak' => 'required',
//     ]);

//     $lomba->update($request->all());

//     return redirect()->route('lomba.index')
//         ->with('success', 'Data Lomba berhasil diperbarui');
// }

