<?php
namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 

class AuthController extends Controller 
{ 
    public function login(Request $request) 
    { 
        $request->validate([ 
            'email' => 'required|email', 
            'password' => 'required', 
        ]); 

        if (Auth::attempt($request->only('email', 'password'))) { 
            return response()->json([ 
                'token' => $request->user()->createToken('api')->plainTextToken, 
                'user' => $request->user(), 
            ]); 
        } 
        return response()->json(['message' => 'Invalid credentials'], 401); 
    } 
    public function logout(Request $request) 
    { 
        $request->user()->currentAccessToken()->delete(); 
        return response()->json(['message' => 'Logged out successfully']); 
    } 


}
