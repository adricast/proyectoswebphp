<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class ModulosController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
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
        $request->validate([
            'imagenmodulo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'ruta' => 'required|string',
            // Asegúrate de ajustar esta validación según tus necesidades
        ]);
           // Procesamiento y almacenamiento de la imagen
            $imagen = $request->file('imagenmodulo');
            $nombreImagen = $request->ruta.'.'.$imagen->getClientOriginalExtension();
            $destino = public_path('img/modulos');
            $request->imagenmodulo->move($destino, $nombreImagen);
            $imagenUrl = $nombreImagen;
        try {
            Modulo::create(
                [
                    'icono' => $imagenUrl,
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'ruta' => $request->ruta,
                  
                ]
            );
        } catch (\Exception $e) {
            dd($e->getMessage());
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
            $destino = public_path('img/modulos');
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

        $ruta= 'img/modulos/'.$modulo->icono;
        unlink($ruta);

          // Retornar una respuesta exitosa en formato JSON
          return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
    
    }
    
  
}
