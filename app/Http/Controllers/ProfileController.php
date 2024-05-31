<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use App\Models\Profile;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            ]);

            // Create a new profile
            $profile = new Profile();
            $profile->user_id = $validatedData['user_id'];

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/profiles'), $imageName);
                $profile->image = 'images/profiles/' . $imageName;
            }

            // Save the profile
            $profile->save();

            // Get the user associated with the profile
            $user = User::findOrFail($profile->user_id);

            // Return a success response with profile data
            return response()->json([
                'message' => 'Profil berhasil dibuat.',
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'image' => $profile->image,
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            // Return an error response
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan profil.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            Log::info("Mencoba mengambil profil dengan ID: $id");

            // Find the profile by ID
            $profile = Profile::findOrFail($id);

            // Get the user associated with the profile
            $user = User::findOrFail($profile->user_id);

            Log::info("Profil dan pengguna ditemukan, ID pengguna: {$user->id}");

            // Return user data with profile image
            return response()->json([
                'name' => $user->name,
                'user_id' => $user->user_id,
                'email' => $user->email,
                'image' => $profile->image,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error("Kesalahan saat mengambil profil: " . $e->getMessage());
            // Return an error response if profile not found or other error occurs
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil profil.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Find the profile by ID
            $profile = Profile::findOrFail($id);

            // Validate the request data
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/profiles'), $imageName);
                $profile->image = 'images/profiles/' . $imageName;
            }

            // Save the profile
            $profile->save();

            // Return a success response with updated profile data
            return response()->json([
                'message' => 'Gambar profil berhasil diperbarui.',
                'image' => $profile->image,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Return an error response
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui gambar profil.',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
