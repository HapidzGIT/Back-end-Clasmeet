<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $token = JWTAuth::getToken();

        if ($token) {
            try {
                JWTAuth::invalidate($token);

                return response()->json([
                    'success' => true,
                    'message' => 'Logout Berhasil! ',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Logout Gagal. Terjadi kesalahan server.',
                ], 500);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Logout Gagal. Token tidak ditemukan.',
        ], 400);
    }
}
