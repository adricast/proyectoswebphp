<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Modulo;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
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
        $usuarios = User::all();
        return view('reikosoft.usuarios.index' , compact('descripcion','user','modulos','usuarios'));
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
        $tipousuario = TipoUsuario::all();
        return view('reikosoft.usuarios.create', compact('descripcion','user','modulos','tipousuario'));
    }	
    public function destroy($id)
    {
        $registro = User::find($id);
         // Verificar si el usuario autenticado es el mismo que se está intentando eliminar
        if (auth()->user()->id === $registro->id) {
            // Retornar una respuesta de error en formato JSON
            return response()->json(['success' => false, 'message' => 'No puedes eliminarte a ti mismo.']);
        }
    
        $registro->delete();
        if ($registro->foto == null) {
            // Retornar una respuesta exitosa en formato JSON
            return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
        }

        if($registro->foto){
            $ruta= 'img/perfiles/'.$registro->foto;
            
            if (file_exists($ruta)) {
                unlink($ruta);
                // Aquí puedes realizar otras acciones después de eliminar el archivo
            } 
        }
       
          // Retornar una respuesta exitosa en formato JSON
          return response()->json(['success' => true, 'message' => 'El registro ha sido eliminado']);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|string',
            'usuario' => 'required|string',
            'tipousuario_id' => 'required|string',
        ]);
        
         
        try {
            User::create(
                [
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'direccion' => $request->direccion,
                    'telefono' => $request->telefono,
                    'email' => $request->email,
                    'username' => $request->usuario,
                    'name' => $request->usuario,
                    'tipousuario_id' => $request->tipousuario_id,
                    'password' => bcrypt($request->usuario),
                ]
                  
                
            );
            return response()->json(['success' => true, 'message' => 'El registro ha sido guardado']);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
            
        

    }
    public function show($id)
    {
        $registro = User::find($id);
        return response()->json($registro);

    }
    public function update(Request $request, $id)
    {
        $registro = User::find($id);
    
        $request->validate([
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|string',
            
       
        ]);
      
    
        // Verificar si se proporcionó una nueva imagen
        if ($request->hasFile('imagenmodulo')) {
            $imagen = $request->file('imagenmodulo');
            $nombreImagen = 'perfil_'.$request->id . '.' . $imagen->getClientOriginalExtension();
            $destino = public_path('img/perfiles');
            $imagen->move($destino, $nombreImagen);
            $imagenUrl = $nombreImagen;
    
            // Actualizar solo si se proporciona una nueva imagen
            $registro->update([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'foto' => $imagenUrl,

            ]);
        } else {
            // Actualizar sin cambiar la imagen
            $registro->update([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'email' => $request->email,

            ]);
        }
    
        
    }    
    public function buscarRegistros(Request $request)
    {
         // Obtener el valor de búsqueda del campo "busqueda"
         $valorBusqueda = $request->input('termino');
 
         // Realizar la búsqueda de registros según el valor proporcionado
         $registros = User::where('username', 'LIKE', "%$valorBusqueda%")
             ->orWhere('nombres', 'LIKE', "%$valorBusqueda%")
             ->orWhere('apellidos', 'LIKE', "%$valorBusqueda%")
             ->get();
 
         // Retornar los registros en formato JSON
         return response()->json($registros->toArray());
     }
}

