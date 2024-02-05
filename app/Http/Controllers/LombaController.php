<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lomba;

class LombaController extends Controller
{
    public function create(Request $request)
    {
        $lomba = new Lomba();
    
        $lomba->nama_lomba = $request->input('nama_lomba');
        $lomba->nama_kelas = $request->input('nama_kelas');
        $lomba->jumlah_pemain = $request->input('jumlah_pemain');
        $lomba->nama_peserta = $request->input('nama_peserta');
        $lomba->jurusan = $request->input('jurusan');
        $lomba->kontak = $request->input('kontak');
    
        $lomba->save();
        return response()->json($lomba);
    }

    public function show()
    {
        $lomba = Lomba::all();
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

