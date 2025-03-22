<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function Register(Request $request) {

        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:13|min:11|unique:users,no_hp',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => "admin"
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function Login(Request $request) {
        $credentials = $request->validate([
            'no_hp' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt(['no_hp' => $request->no_hp, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        return back()->with('error', 'No HP atau Password salah.');
    }
}
