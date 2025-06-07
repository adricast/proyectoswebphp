<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>REIKOSOFT</title>
   <script src="{{ route('recursos.show', ['fontawesome/js', 'all.js']) }}"></script>
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ route('recursos.show', ['img', 'min.png']) }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <script src="{{ route('recursos.show', ['js', 'funciones.js']) }}"></script>
    <script src="{{ route('recursos.show', ['js/reiko/', 'funcionesreiko.js']) }}"></script>
    <script src="{{ route('recursos.show', ['js', 'script.js']) }}" defer></script>
   <link href="{{ asset('css/estilo_contenedores.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo_reiko.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    

</head>
<section id="reikocontenedor">
    
    <div id="infosystem">
        @if(isset($user))
            @if (isset($user->foto))
                <img src="{{ route('recursos.show', ['img/perfiles', $user->foto]) }}" alt="" width="40px" height="40px" >
            @else
                <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt="" width="40px" height="40px" >
            @endif
            @if (isset($user->typeUser->descripcion))
                <p>{{ $user->typeUser->descripcion }} -</p>
                
            @endif

            <p>{{ $user->name }}</p>
            <!-- Puedes mostrar otros atributos del usuario aquí -->
        @else
            <p>No hay información de usuario disponible.</p>
        @endif
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
<<<<<<< HEAD
        <a href="{{ route('logout') }}" class="salir" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-right-from-bracket"></i></a>
=======
        <a href="{{ route('logout') }}" class="salir" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
>>>>>>> 7327fdf (07-06-2025 Roles Middleware y Rutas)
                
    </div>
    <div id="contenedormodulos">
        <button class="prevbuttonmenu" id="prevButton">&#8249;</button>
        <div id="modulos">
            
            <a class="modulo" href="{{ route('posts.index') }}">
                <img src="{{ route('recursos.show', ['img/modulos', 'home.png']) }}"  alt="" width="40px" height="40px" title="Home">
            </a>
            <a href="{{ route('cmodulos.index') }}">
                <img src="{{ route('recursos.show',['img/modulos', 'modulos.png']) }}" alt="" width="40px" height="40px" title="Modulos">
            </a>
            @foreach ($modulos as $modulo)
                @if (Route::has($modulo->ruta.'.index'))
                <a href="{{ route($modulo->ruta.'.index') }}">
                    <img src="{{ asset('img/modulos/' . $modulo->icono) }}" alt="{{ $modulo->nombre }}" width="40px" height="40px" title="{{ $modulo->nombre }}">
                </a>
                @else
                <a href="#">
                    <img src="{{ asset('img/modulos/'. $modulo->icono) }}" alt="Imagen Perfil" width="40px" height="40px" title="{{ $modulo->nombre }}">
                </a>
                @endif
             @endforeach
       
        </div>
        <button class="nextbuttonmenu" id="nextButton">&#8250;</button>
        <script> funciontarjeta2();</script>
       
    </div>
    <div id="contenedorprincipal">
            @yield('contenidoreiko')
            <!-- Scripts -->
            @stack('scripts')
    </div>

    <div id="piepagina">
         REIKO TECNOLOGY 2023
    </div>
</section>


