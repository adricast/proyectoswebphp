<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class ModulosController extends Controller
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
        return view('reikosoft.modulos.index', compact('descripcion','user','modulos'));

    }
    public function create()
    {
        $typeUser = auth()->user()->typeUser;
      
        $user = Auth::user();
        if ($typeUser) {
            $descripcion = $typeUser->descripcion;
        } else {
            $descripcion = 'No asignado';
        }
        $modulos = Modulo::all();


        return view('reikosoft.modulos.create', compact('descripcion','user','modulos'));
    }	
    public function store(Request $request)
{
    try {
        $request->validate([
            'imagenmodulo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'ruta' => 'required|string',
        ]);

        $imagen = $request->file('imagenmodulo');
        $nombreImagen = $request->ruta.'.'.$imagen->getClientOriginalExtension();
        $destino = public_path($this->rutaConcat.'img/modulos');
        
        // Verifica si la carpeta destino existe
        if (!file_exists($destino)) {
            mkdir($destino, 0775, true);
        }

        $imagen->move($destino, $nombreImagen);
        $imagenUrl = $nombreImagen;

        Modulo::create([
            'icono' => $imagenUrl,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'ruta' => $request->ruta,
        ]);

        return response()->json(['success' => true, 'message' => 'Módulo creado correctamente']);
    } catch (\Throwable $e) {
        // Registrar el error y retornar 500 controlado
        \Log::error('Error en store(): ' . $e->getMessage());
        return response()->json(['error' => 'Error interno: '.$e->getMessage()], 500);
    }
}

    public function show($id)
    {
        $registro = Modulo::find($id);
        return response()->json($registro);

    }
      
    public function update(Request $request, $id)
    {
        $registro = Modulo::find($id);
    
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'ruta' => 'required|string',
        ]);
    
        // Verificar si se proporcionó una nueva imagen
        if ($request->hasFile('imagenmodulo')) {
            $imagen = $request->file('imagenmodulo');
            $nombreImagen = $request->ruta . '.' . $imagen->getClientOriginalExtension();
            $destino = public_path($this->rutaConcat.'img/modulos');
            $imagen->move($destino, $nombreImagen);
            $imagenUrl = $nombreImagen;
    
            // Actualizar solo si se proporciona una nueva imagen
            $registro->update([
                'icono' => $imagenUrl,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'ruta' => $request->ruta,
            ]);
        } else {
            // Actualizar sin cambiar la imagen
            $registro->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'ruta' => $request->ruta,
            ]);
        }
    
        
    }
    
    public function destroy($id)
    {
        $modulo = Modulo::find($id);
        $modulo->delete();

        $ruta= $this->rutaConcat.'img/modulos/'.$modulo->icono;
        unlink($ruta);

          // Retornar una respuesta exitosa en formato JSON
          return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
    
    }
    
  
}
