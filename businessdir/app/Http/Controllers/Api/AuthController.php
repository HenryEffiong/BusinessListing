<?php

namespace App\Http\Controllers\Api;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
       
        $validatedData = $request -> validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request ->password);
        
        $user = User::create($validatedData);
        
        $accessToken = $user -> createToken('loginToken') ->accessToken;
        
        return response(['user' => $user, 'access_Token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request -> validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);
        
        if (!Auth::attempt($loginData)) {
            return response(['message' => 'Invalid login credentials']);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_Token' => $accessToken]);
    }

}
