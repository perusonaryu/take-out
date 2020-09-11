<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    public function login(Request $request){
        $request -> validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only('email', 'password'))){
            return response()->json(Auth::user(), 200);
        }
        throw ValidationException::withMessages([
            'email' =>['The provided credentials are incorect.']
        ]);

        
        // $result = false;
        // $status = 401;
        // $message = 'ユーザが見つかりません。';
        // $user = null;
        // $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) {
        //     // Success
        //     $result = true;
        //     $status = 200;
        //     $message = 'OK';
        //     $user = Auth::user();
        //     // ※古いトークン削除&新しいトークン生成
        //     $user->tokens()->where('name', 'token-name')->delete();
        //     $token = $user->createToken('token-name')->plainTextToken;
        // }
        // return response()->json(['result' => $result, 'status' => $status, 'message' => $message]);
    }

    public function logout()
    {
        Auth::logout();
    }
}
