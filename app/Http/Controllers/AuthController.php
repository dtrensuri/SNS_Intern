<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'], 
            'password' => ['required']
        ]);
        if (Auth()->attempt($credentials)) {
            $email = $credentials["email"];

            $user = User::where('email', $email)->first();
            $request->session()->regenerate();
            Auth::login($user);
            return back();
        } else {
            return back()->withErrors([
                'login' => 'Sai tên đăng nhập hoặc mật khẩu.',
            ])->withInput(['email']);
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('guest.login_page');
    }
}