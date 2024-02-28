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
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User tidak terautentikasi'], 403);
        }
        
        $request->validate([
            'message' => 'required|string',
        ]);

        $chat = Chat::create([
            'user_id' => $user->id,
            'message' => $request->message,
        ]);

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
        
        // Mengambil informasi lengkap dari setiap chat
        $messages = $chats->map(function ($chat) {
            return [
                'id' => $chat->id,
                'user_id' => $chat->user_id,
                'message' => $chat->message,
                'created_at' => $chat->created_at,
                'updated_at' => $chat->updated_at,
            ];
        });
        
        return response()->json(['messages' => $messages], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal mengambil pesan chat'], 500);
    }
}

public function delete($id)
{
    $chat = Chat::find($id);
    if (!$chat) {
        return response()->json(['error' => 'Chat tidak ditemukan'], 404);
    }
    $chat->delete();

    return response()->json(['message' => 'Resource deleted successfully']);
}

}