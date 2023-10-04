<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function prosesLogin(LoginRequest $request){
        try {
            $request->validated();

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = JWTAuth::fromUser($user);
                session(['jwt_token' => $token]);

                return redirect('/product');
            } else {
                return redirect('/');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return redirect('/')->withErrors($e->errors());
        }
    }

    public function logout(){
        if (Session::has('jwt_token')) {
            try {
                $token = session('jwt_token');

                JWTAuth::invalidate($token);
            } catch (\Exception $e) {
            }
            Session::forget('jwt_token');
            Auth::logout();
        }

        return redirect('/');
    }
}
