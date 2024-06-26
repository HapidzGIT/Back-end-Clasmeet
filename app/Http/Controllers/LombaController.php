<?php

namespace App\Http\Controllers;

use App\Models\buat_lomba;
use Illuminate\Http\Request;
use App\Models\Lomba;
use Illuminate\Support\Facades\Auth;

class LombaController extends Controller
{

    public function getNamaLomba()
    {
        // Ambil nama lomba terbaru dari tabel buat_lomba
        $namaLomba = buat_lomba::latest()->value('nama_lomba');

        return response()->json([
            'nama_lomba' => $namaLomba,
        ]);
    }

  // LombaController.php
  public function create(Request $request)
  {
      // Validasi input
      $request->validate([
          'nama_peserta' => 'required|string',
          'nama_kelas' => 'required|string',
          'jumlah_pemain' => 'required|integer',
          'jurusan' => 'required|string',
          'kontak' => 'required|string',
          'nama_lomba' => 'required|string',
          'buat_lomba_id' => 'required|exists:buat_lomba,id',
      ]);

      // Periksa apakah user sudah login
      if (!auth()->check()) {
          return response()->json(['message' => 'Unauthorized'], 401);
      }

      $lomba = new Lomba();
      $lomba->user_id = auth()->user()->id; // Tambahkan user_id dari pengguna yang sedang login
      $lomba->nama_kelas = $request->input('nama_kelas');
      $lomba->jumlah_pemain = $request->input('jumlah_pemain');
      $lomba->nama_peserta = $request->input('nama_peserta');
      $lomba->jurusan = $request->input('jurusan');
      $lomba->kontak = $request->input('kontak');
      $lomba->buat_lomba_id = $request->input('buat_lomba_id');

      // Simpan data Lomba
      $lomba->save();

      // Ambil nama_lomba dari tabel buat_lomba menggunakan relasi yang sudah didefinisikan di model Lomba
      $namaLomba = buat_lomba::findOrFail($lomba->buat_lomba_id)->nama_lomba;

      // Susun respons JSON dengan bidang 'nama_lomba' di atas
      $responseData = [
          'data' => $lomba->toArray(), // Ubah objek ke array untuk mengambil data dari model
      ];

      // Tambahkan 'nama_lomba' ke dalam array 'data' agar berada di atas
      $responseData['data']['nama_lomba'] = $namaLomba;

      return response()->json($responseData, 201);
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


    public function showAll(Request $request)
    {

    $lomba = Lomba::with('buatLomba')->get();

    // Jika tidak ada data lomba, kirim respons 404 Not Found
    if ($lomba->isEmpty()) {
        return response()->json(['message' => 'Tidak ada data Lomba yang tersedia'], 404);
    }

    // Format data yang akan dikembalikan dalam respons
    $formattedData = [];
    foreach ($lomba as $item) {
        // Periksa apakah relasi buatLomba ada
        if ($item->buatLomba) {
            $formattedData[] = [
                'id' => $item->id,
                'nama_kelas' => $item->nama_kelas,
                'jumlah_pemain' => $item->jumlah_pemain,
                'nama_peserta' => $item->nama_peserta,
                'jurusan' => $item->jurusan,
                'kontak' => $item->kontak,
                'nama_lomba' => $item->buatLomba->nama_lomba, // Menambahkan nama_lomba dari relasi
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        }
    }


    // Kirim respons dengan data lomba yang telah diformat
    return response()->json($formattedData);
    }

    public function update(Request $request, $id)
    {
        $lomba = Lomba::findOrFail($id);
        // $lomba->nama_lomba = $request->input('nama_lomba');
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
    public function showUserHistory($userId)
{
    // Temukan semua data lomba dengan relasi 'buatLomba' untuk user tertentu
    $lomba = Lomba::with('buatLomba')->where('user_id', $userId)->get();

    // Jika tidak ada data lomba, kirim respons 404 Not Found
    if ($lomba->isEmpty()) {
        return response()->json(['message' => 'Tidak ada data Lomba yang tersedia'], 404);
    }

    // Format data yang akan dikembalikan dalam respons
    $formattedData = [];
    foreach ($lomba as $item) {
        // Periksa apakah relasi buatLomba ada
        if ($item->buatLomba) {
            $formattedData[] = [
                'id' => $item->id,
                'nama_kelas' => $item->nama_kelas,
                'jumlah_pemain' => $item->jumlah_pemain,
                'nama_peserta' => $item->nama_peserta,
                'jurusan' => $item->jurusan,
                'kontak' => $item->kontak,
                'nama_lomba' => $item->buatLomba->nama_lomba,
                'created_at' => $item->created_at->toDateTimeString(),
                'updated_at' => $item->updated_at->toDateTimeString()
            ];
        }
    }

    return response()->json($formattedData);
}
public function getLombaByUser()
{
    if (!Auth::check()) {
        return response()->json(['message' => 'User not authenticated'], 401);
    }

    $userId = Auth::id();
    $userName = Auth::user()->name;
    $lomba = Lomba::with('buatLomba')->where('user_id', $userId)->get();

    if ($lomba->isEmpty()) {
        return response()->json(['message' => 'Tidak ada lomba yang terdaftar untuk pengguna ini'], 404);
    }

    $responseData = [];
    foreach ($lomba as $item) {
        if ($item->buatLomba) {
            $responseData[] = [
                'id' => $item->id,
                'nama_lomba' => $item->buatLomba->nama_lomba,
                'nama_kelas' => $item->nama_kelas,
                'jumlah_pemain' => $item->jumlah_pemain,
                'nama_peserta' => $item->nama_peserta,
                'jurusan' => $item->jurusan,
                'message' => "Kamu, telah terdaftar di lomba " . $item->buatLomba->nama_lomba,
            ];
        }
    }

    return response()->json($responseData);
}
}
