<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view('paginas.reikosoft');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            $user = Auth::user();
            return redirect()->route('posts.index',compact('user')); // Cambia 'dashboard' por la ruta a la que deseas redirigir después del inicio de sesión.
        } else {
            // Autenticación fallida
            return back()->with('error', 'Usuario o contraseña incorrecta');
        }
            
        
        
    }   

}
