<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\User;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
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
        // Obtener todos los usuarios únicos que han enviado o recibido mensajes contigo
           // Obtener todos los usuarios únicos que han enviado o recibido mensajes contigo
       
       
           // Obtener todos los mensajes donde el usuario autenticado es el remitente o el destinatario
        $messages = Chat::where('sender_id', auth()->id())
        ->orWhere('receiver_id', auth()->id())
        ->latest()
        ->get();

        // Crear una colección para almacenar los mensajes agrupados por el ID del otro usuario
        $userMessages = collect([]);

        // Iterar sobre los mensajes y agruparlos por el ID del otro usuario
        foreach ($messages as $message) {
        // Determinar el ID del otro usuario en la conversación
        $otherUserId = ($message->sender_id === auth()->id()) ? $message->receiver_id : $message->sender_id;

        // Verificar si ya existe una entrada para este usuario en la colección
        if (!$userMessages->has($otherUserId)) {
        // Si no existe, crear una nueva entrada en la colección
        $userMessages[$otherUserId] = [
        'user' => User::find($otherUserId),
        'last_message' => $message->message,
        'timestamp' => $message->created_at->format('Y-m-d H:i:s')
        ];
        }
        }

return view('reikosoft.chats.index', compact('descripcion', 'user', 'modulos', 'userMessages'));
}
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'username' => 'required|string',
            'mensaje' => 'required|string',
        ]);
    
        // Obtener el ID del usuario receptor a partir del nombre de usuario
        $receiver = User::where('username', $request->username)->first();
    
        // Verificar si el usuario receptor existe
        if ($receiver) {
            // Crear un nuevo mensaje
            $chat = new Chat();
            $chat->sender_id = auth()->id(); // ID del remitente (usuario autenticado)
            $chat->receiver_id = $receiver->id; // ID del receptor
            $chat->message = $request->mensaje; // Mensaje enviado
            $chat->status = 'no_leido'; // Establecer el estado como "no_leído"
            $chat->sent_at = Carbon::now(); // Establecer la fecha y hora de envío actual
          
            $chat->save();
    
            // Aquí podrías realizar otras acciones, como enviar notificaciones, etc.
    
            // Retornar una respuesta JSON con éxito
            return response()->json(['success' => 'El mensaje se ha enviado correctamente.']);
        } else {
            // El usuario receptor no existe
            return response()->json(['error' => 'El usuario receptor no existe.']);
        }
    }
    public function show($userId)
    {
          // Obtener el ID del usuario autenticado
    $authUserId = Auth::id();

    // Obtener los mensajes relacionados con el usuario autenticado y el usuario con el que se está chateando
    $mensajes = Chat::where(function ($query) use ($authUserId, $userId) {
            $query->where('sender_id', $authUserId)->where('receiver_id', $userId);
        })
        ->orWhere(function ($query) use ($authUserId, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $authUserId);
        })
        ->orderBy('created_at', 'asc') // Ordenar por fecha y hora de creación en orden ascendente
        ->get();

    // Marcar los mensajes como enviados o recibidos
    foreach ($mensajes as $mensaje) {
        $mensaje->tipo = ($mensaje->sender_id == $authUserId) ? 'enviado' : 'recibido';
    }

    // Retornar los mensajes como respuesta en formato JSON
    return response()->json($mensajes);

    }

}
