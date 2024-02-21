<?php
namespace App\Http\Controllers;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5); // Menampilkan 10 pengguna per halaman
        return response()->json($users);
    }

    
    public function showId($id)
    {
        $users = User::find($id);
        return response()->json($users);
    }

    public function destroy($id)
    {
        $users = User::find($id);
    
        if (!$users) {
            return response()->json(['message' => 'Not Found'], 404);
        }
    
        $users->delete();
    
        return response()->json(['message' => 'Resource deleted successfully']);
    }
}
