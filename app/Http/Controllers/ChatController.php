<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            // Mengambil user yang sedang login
            $user = Auth::user();
            
            // Validasi tidak lagi memerlukan 'user_id'
            $request->validate([
                'message' => 'required|string',
            ]);

            $chat = Chat::create([
                'user_id' => $user->id, // Menggunakan ID pengguna yang sedang login
                'message' => $request->message,
            ]);

            // Ambil nama pengguna dari pengguna yang sedang login
            $userName = $user->name;

            return response()->json(['message' => 'Chat berhasil disimpan', 'user_name' => $userName], 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()->first()], 422);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Gagal menyimpan chat'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    
    public function getMessage()
    {
        try {
            $chats = Chat::all();
            
            $messages = $chats->pluck('message');
            
            return response()->json(['messages' => $messages], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal mengambil pesan chat'], 500);
        }
    }
    
    public function delete($id)
    {
        try {
            $chat = Chat::find($id);
            
            if (!$chat) {
                return response()->json(['error' => 'Chat tidak ditemukan'], 404);
            }
            
            $chat->delete();
    
            return response()->json(['message' => 'Chat berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus chat'], 500);
        }
    }
    
}
