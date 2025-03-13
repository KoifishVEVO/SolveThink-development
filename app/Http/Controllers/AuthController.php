<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function showLogin()
    {
        return view('login'); 
    }

    public function showRegister()
    {
        return view('register'); 
    }

    public function Register() {
        //will be post later


    }

    public function Login() {
    //will be post later
    
    }
}
