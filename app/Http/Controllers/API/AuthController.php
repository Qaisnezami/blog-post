<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        
        $user = User::where('email', $request->email)->first();
        
        if (! $user || ! Hash::check($request->password, $user->password)) {
           return "Your Email or Password is incorrect";
        }
 
        $data = [
            'user'=> $user,
            'token'=>$user->createToken($user->name)->plainTextToken
        ];

        return $data;
         
    }


    public function register(RegisterRequest $request){

        $user = User::create(
            [
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'name'=>$request->name,
            'user_role'=>1
        ]);

        $data = [
            'user'=> $user,
            'token'=>$user->createToken($user->name)->plainTextToken
        ];

        return $data;
    }


    public function logout(Request $request){

        $user = $request->user();
        $user->tokens()->delete();
        
        return "User is Logout";
    }



    
}
