@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'chatsreiko.js']) }}"></script>
    <script>
        var StoreUrl = "{{ route('chats.store') }}";   
    </script>
    <section class="containerreiko">
    
        <div class="contenedorchat">
            <div class="addchat">
                <button class="btnaddchat" onclick="addChat()">Agregar Chat</button>
            </div>
            <div class="searchchat">
                <input type="text" name="busqueda" id="busqueda" placeholder="Busqueda de Datos" onkeyup="consultaDatos()" style="width: 200px;">
                <button class="busqueda" onclick="searchChat()"> Buscar </button>

            </div>
            <div class="headerchat" id="headerchat">
                
            </div>
            <div class="userschat" id="userschat">
                
                @foreach($userMessages as $userMessage)
                <div class="userchat" id="userchat_{{ $userMessage['user']->id }}">
                    <div class="userchatimg">
                        @if($userMessage['user']->foto)
                            <img src="{{ asset('img/perfiles/' . $userMessage['user']->foto) }}" alt="Foto de perfil">
                        @else
                            <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt="Foto de perfil">
                        @endif
                    </div>
                    <div class="userchatinfo">
                        <p class="username" id="username_{{ $userMessage['user']->id }}">{{ $userMessage['user']->name }}</p>
                        <p class="message-preview">{{ $userMessage['last_message'] }}</p>
                        <p class="timestamp">{{ $userMessage['timestamp'] }}</p>
                    </div>
                </div>
                @endforeach
                <script>
                    $(document).ready(function() {
                        $('.userchat').click(function() {
                            var userId = $(this).attr('id').split('_')[1]; // Obtener el ID de usuario del ID del userchat
                            var username = $('#username_' + userId).text();
                            $('#headerchat').data('userid', userId);
                            // Actualizar el contenido del headerchat con el nombre del usuario
                            $('#headerchat').text(username);
                            cargarMensajes(userId);
                        });
                    });

                </script>
                

            </div>
            <div class="chatbox" id="chatbox">
                
            </div>
            <div class="chatwrite">
                <input type="text" name="mensaje" id="mensaje" placeholder="Escribe un mensaje">
                <button class="enviarchat" onclick="enviarMensaje()"> Enviar </button>
            </div>
        </div>
       
    </section>
   
    @include('reikosoft.chats.create') 
@endsection