<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $rutaConcat;
    public function __construct()
    {
        $this->middleware('auth');
        $this->rutaConcat = config('app.ruta_concat');
    }
    public function index(User $user){
        $typeUser = auth()->user()->typeUser;
      
        $user = Auth::user();
        if ($typeUser) {
            $descripcion = $typeUser->descripcion;
        } else {
            $descripcion = 'No asignado';
        }
        $modulos=Modulo::all();
       return view('reikosoft.presentacion', compact('descripcion','user','modulos'));
       
    }
}
