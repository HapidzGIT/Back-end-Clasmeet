<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        $user = auth()->user();

        return $this->authenticated($request, $user, $token);
    }

    protected function authenticated(Request $request, $user, $token)
    {
        // Lakukan otentikasi pengguna
        auth()->login($user);

        $response = [
            'success' => true,
            'data' => [
                'user' => [
                    'id' => auth()->user()->id,
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email
                ],
                'token' => $token,
            ],
        ];

        // Periksa dan tambahkan roles ke array jika pengguna memiliki peran tertentu
        if ($user->hasRole('admin')) {
            $response['roles'][] = 'admin';
            // Sinkronkan izin untuk pengguna
            $user->syncPermissions(['users.index', 'users.create', 'users.edit']);
            $response['permissions']['users.index'] = $user->hasPermissionTo('users.index');
            $response['permissions']['users.create'] = $user->hasPermissionTo('users.create');
            $response['permissions']['users.edit'] = $user->hasPermissionTo('users.edit');
        }

        if ($user->hasRole('user')) {
            // Jika pengguna adalah user, tambahkan role user ke dalam respons
            $response['roles'][] = 'user';
        }

        return response()->json($response, 200);
    }
}
