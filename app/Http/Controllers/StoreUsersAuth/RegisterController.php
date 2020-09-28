<?php

namespace App\Http\Controllers\StoreUsersAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\StoreUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{

    

    // public function __construct()
    // {
    //     $this->middleware('auth:storeuser');
    // }

    public function register(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:store_users'],
            'password' =>['required', 'min:6', 'confirmed']
        ]);

        StoreUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if (Auth::guard('storeuser')->attempt($request->only('email', 'password'))){
            return response()->json(Auth::guard('storeuser')->user(), 200);
        }

        throw ValidationException::withMessages([
            'email' =>['The provided credentials are incorect.']
        ]);

        
    }

    // protected function guard(){
    //     return Auth::guard('storeuser');
    // }

    
}
