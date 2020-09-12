<?php

namespace App\Http\Controllers\StoreUsersAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    // protected function guard()
    // {
    //     return Auth::guard('storeuser');
    // }

    //     public function __construct()
    // {
    //     $this->middleware('auth:storeuser');
    // }

    public function login(Request $request){
        $request -> validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if (Auth::guard('storeuser')->attempt($request->only('email', 'password'))){
            return response()->json(Auth::guard('storeuser')->user(), 200);
        }

        throw ValidationException::withMessages([
            'email' =>['The provided credentials are incorect.']
        ]);

    }

    public function logout()
    {
        Auth::guard('storeuser')->logout();
    }

    // protected function guard(){
    //     return Auth::guard('storeuser');
    // }
}
