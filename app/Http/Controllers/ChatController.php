<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class ChatController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'message' => 'required|string',
            ], [
                'user_id.exists' => 'User ID yang dipilih tidak valid.',
            ]);

            $chat = Chat::create([
                'user_id' => $request->user_id,
                'message' => $request->message,
            ]);

            // Ambil nama pengguna
            $userName = $chat->user->name;

            return response()->json(['message' => 'Chat berhasil disimpan', 'user_name' => $userName], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()->first()], 422);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Gagal menyimpan chat'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
