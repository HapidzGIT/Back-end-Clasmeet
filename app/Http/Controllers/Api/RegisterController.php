<?php

namespace App\Http\Controllers\Api;

use  App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //set validator
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:8|confirmed'
        ]);

        //jika validator gagal
        if ($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        //create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //respon balik pengguna json terbuat
        if($user){
            $user->assignRole('user');
            return response()->json([
             'success' => true,
             'user' => $user,
            ],201);
        }


        //respon balik jika pengguna json gagal
        return response()->json([
            'success' => false,
        ], 409);
    }
}
