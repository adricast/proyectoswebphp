<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilesController extends Controller
{
    //
    protected $rutaConcat;
    public function __construct()
    {
        $this->middleware('auth');
        $this->rutaConcat = config('app.ruta_concat');
    }
    public function index()
    {
        $typeUser = auth()->user()->typeUser;
      
        $user = Auth::user();
        if ($typeUser) {
            $descripcion = $typeUser->descripcion;
        } else {
            $descripcion = 'No asignado';
        }
        $modulos = Modulo::all();
        return view('reikosoft.perfiles.index' , compact('descripcion','user','modulos'));

    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $registro = User::find($user->id);
    
        // Validación de campos
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'nuevacontraseña' => 'nullable|min:6',
            'contraseña' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('La contraseña actual es incorrecta.');
                    }
                },
            ],
        ]);
        // Verificar que la contraseña actual sea válida
        if (!Hash::check($request->contraseña, $user->password)) {
            return redirect()->route('perfil.index')->with('error', 'La contraseña actual es incorrecta.');
        }
       
        // Actualizar campos simples
        $registro->email = $request->email;
        $registro->telefono = $request->telefono;
        $registro->direccion = $request->direccion;

        // Actualizar contraseña si se proporciona una nueva
        if ($request->filled('nuevacontraseña')) {
            $registro->password = bcrypt($request->nuevacontraseña);
        }
            // Actualizar imagen si se proporciona una nueva
        if ($request->hasFile('imagenmodulo')) {
            $imagen = $request->file('imagenmodulo');
            $nombreImagen = 'perfil_' . $user->id . '.' . $imagen->getClientOriginalExtension();
            $destino = public_path($this->rutaConcat.'img/perfiles');
            $imagen->move($destino, $nombreImagen);
            $registro->foto = $nombreImagen;
        }

        // Guardar cambios
      
        $registro->save();



    }
}
