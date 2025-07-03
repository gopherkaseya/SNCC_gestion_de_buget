<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function loginPost(Request $request){

        $credentials = $request->validate(['email'=>'required|email','password'=>'required']);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->role == "chefdepartement"){
                return redirect('/chef-departement');
            }
            if(Auth::user()->role == "responsablefinance"){
                return redirect('/responsable-finance');
            }
            if (Auth::user()->role == "controleurgestion"){
                return redirect('/controleur-gestion');
            }
            if(Auth::user()->role == "compatble"){

            }
            if(Auth::user()->role == "auditeurinterne"){

            }
            if (Auth::user()->role == "directeurgeneral"){
                return redirect('/directeur-general');
            }


        }else{
            return back()->withErrors(["email"=>"L'email ou le mot de passe est invalide"]);
        }
    }

    public  function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
