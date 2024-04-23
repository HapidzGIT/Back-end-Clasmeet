<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\buat_lomba;

class BuatLombaController extends Controller
{
    public function imageUpload(Request $req)
    {
        $buatLomba = new buat_lomba;

        if ($req->hasFile('image')) {
            $filename = $req->file('image')->getClientOriginalName();
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME);
            $getfileExtension = $req->file('image')->getClientOriginalExtension();
            $createnewFileName = time() . '_' . str_replace(' ', '_', $getfilenamewitoutext) . '.' . $getfileExtension;
            $img_path = $req->file('image')->storeAs('public/post_img', $createnewFileName);
            $buatLomba->image = $createnewFileName;
        }

        $buatLomba->nama_pj = $req->nama_pj; //Menyimpan Nilai dari Nama_pj
        $buatLomba->kontak = $req->kontak; //Menyimpan Nilai dari Kontak
        $buatLomba->nama_lomba = $req->nama_lomba; // Menyimpan nilai nama_lomba dari request

        if ($buatLomba->save()) {
            return ['status' => true, 'message' => "Image uploaded successfully"];
        } else {
            return ['status' => false, 'message' => "Error: Image not uploaded successfully"];
        }
    }

    public function show()
    {
        $buatLomba = buat_lomba::paginate(3); // Menggunakan paginate untuk membagi data ke dalam beberapa halaman

        return response()->json($buatLomba);
    }

    public function showId($id)
    {
        $buatLomba = buat_lomba::find($id);

        if (!$buatLomba) {
            return response()->json(['status' => false, 'message' => 'Data not found'], 404);
        }

        return response()->json(['status' => true, 'data' => $buatLomba]);
    }
}
