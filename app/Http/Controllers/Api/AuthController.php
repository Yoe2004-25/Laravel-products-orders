<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
   public function register(Request $request) 
   {
        $validated = $request->validate([
            'name'=>['required','string','max:225'], 
            'email'=>['required','string','email','max:225','unique:users'],
            'password'=>['required','string','max:10','confirmed'],
        ]);

        $user = User::create([
            'name'=>$validated['name'], 
            'email'=>$validated['email'],
            'password'=>$validated['password'],
        ]);

        $token = User::createToken('auth-Token')->plainTextToken;


        return response()->json([
            'message'=>'user registed', 
            'user'=>$user, 
            'token'=>$token,
        ]);
   }

   public function login(Request $request)
   {
        $request->validate([
            'email'=>'required|email', 
            'password'=>'required',
        ]);
        
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password))
        {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->tokens()->delete() ; 

        $token = $user->createToken('auth-token')->plainTextToken ; 

        return response()->json([
              'message'=>'user registed', 
            'user'=>$user, 
            'token'=>$token,
        ]);

   }
}