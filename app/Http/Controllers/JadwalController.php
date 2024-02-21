<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function create(Request $request)
    {
        $jadwal = new Jadwal();
    
        $jadwal->nama_lomba = $request->input('nama_lomba');
        $jadwal->tanggal = $request->input('tanggal');
        $jadwal->kelas = $request->input('kelas');
        $jadwal->tempat = $request->input('tempat');
        $jadwal->keterangan = $request->input('keterangan');
      
    
        $jadwal->save();
        return response()->json($jadwal);
    }

    public function show()
    {
        $jadwal = Jadwal::paginate(5); 
        return response()->json($jadwal);
    }

    public function showId($id)
    {
        $jadwal = Jadwal::find($id);
        return response()->json($jadwal);
    }

    public function update(Request $request, $id)
    {
    $jadwal = Jadwal::findOrFail($id);
        $jadwal->nama_lomba = $request->input('nama_lomba');
        $jadwal->tanggal = $request->input('tanggal');
        $jadwal->kelas = $request->input('kelas');
        $jadwal->tempat = $request->input('tempat');
        $jadwal->keterangan = $request->input('keterangan');

    $jadwal->save();
    return response()->json($jadwal);
    }

    public function destroy($id)
{
    $jadwal = Jadwal::find($id);

    if (!$jadwal) {
        return response()->json(['message' => 'Not Found'], 404);
    }

    $jadwal->delete();

    return response()->json(['message' => 'Resource deleted successfully']);
}
}

