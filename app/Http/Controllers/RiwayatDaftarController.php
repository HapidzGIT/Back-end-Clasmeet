<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatDaftar;

class RiwayatDaftarController extends Controller
{
    public function index()
    {
        $riwayatDaftar = RiwayatDaftar::all();
        return response()->json($riwayatDaftar);
    }
}
