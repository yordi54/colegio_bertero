<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view("login.index");
    }

    public function ingresar(Request $request) {        
        $credentials = $request->validate([
            "email" => "required | email",
            "password" => "required"
        ]);

        $remember = $request->filled("remember");

        if( Auth::attempt($credentials, $remember) ){
            $request->session()->regenerate();
            return redirect("home");
        }
        return redirect()->route("login");
    }

    public function logout() {
        Auth::logout();
        return redirect()->route("login");
    }
}
