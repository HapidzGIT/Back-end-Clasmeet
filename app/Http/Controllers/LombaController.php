<?php

namespace App\Http\Controllers;

use App\Models\buat_lomba;
use Illuminate\Http\Request;
use App\Models\Lomba;

class LombaController extends Controller
{
    // Method untuk mendapatkan nama lomba
    public function getNamaLomba()
    {
        // Ambil nama lomba terbaru dari tabel buat_lomba
        $namaLomba = buat_lomba::latest()->value('nama_lomba');

        return response()->json([
            'nama_lomba' => $namaLomba,
        ]);
    }

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

    // Susun respons JSON dengan bidang 'nama_lomba' di atas
    $responseData = [
        'data' => $lomba->toArray(), // Ubah objek ke array untuk mengambil data dari model
    ];

    // Hapus 'nama_lomba' dari 'data'
    unset($responseData['data']['nama_lomba']);

    // Gabungkan 'nama_lomba' ke dalam array 'data' agar berada di atas
    $responseData['data'] = array_merge(['nama_lomba' => $namaLomba], $responseData['data']);

    return response()->json($responseData, 201);
}
    
    

    


    public function show()
    {
        $lomba = Lomba::paginate(5); 
        return response()->json($lomba);
    }

    public function showId($id)
    {
        // Temukan data lomba berdasarkan ID
        $lomba = Lomba::with('buatLomba')->find($id);

        // Jika data tidak ditemukan, kirim respons 404 Not Found
        if (!$lomba) {
            return response()->json(['message' => 'Data Lomba tidak ditemukan'], 404);
        }

        // Format data yang akan dikembalikan dalam respons
        $formattedData = [
            'id' => $lomba->id,
            'nama_lomba' => $lomba->buatLomba->nama_lomba,
            'nama_kelas' => $lomba->nama_kelas,
            'jumlah_pemain' => $lomba->jumlah_pemain,
            'nama_peserta' => $lomba->nama_peserta,
            'jurusan' => $lomba->jurusan,
            'kontak' => $lomba->kontak,
            'created_at' => $lomba->created_at,
            'updated_at' => $lomba->updated_at,
        ];

        // Kirim respons dengan data lomba yang telah diformat
        return response()->json($formattedData);
    }
    

    public function showAll()
    {
    // Temukan semua data lomba
    $lomba = Lomba::with('buatLomba')->get();

    // Jika tidak ada data lomba, kirim respons 404 Not Found
    if ($lomba->isEmpty()) {
        return response()->json(['message' => 'Tidak ada data Lomba yang tersedia'], 404);
    }

    // Format data yang akan dikembalikan dalam respons
    $formattedData = [];
    foreach ($lomba as $item) {
        $formattedData[] = [
            'id' => $item->id,
            'nama_lomba' => $item->buatLomba->nama_lomba,
            'nama_kelas' => $item->nama_kelas,
            'jumlah_pemain' => $item->jumlah_pemain,
            'nama_peserta' => $item->nama_peserta,
            'jurusan' => $item->jurusan,
            'kontak' => $item->kontak,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    }

    // Kirim respons dengan data lomba yang telah diformat
    return response()->json($formattedData);
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

