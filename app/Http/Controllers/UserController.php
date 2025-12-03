<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $remember = $request->boolean('remember');

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Onjuiste gebruikersnaam of wachtwoord. Probeer het opnieuw.',
        ])->withInput();
    }
}
