@extends('estructura.cabecera')

@section('titulo', 'reikosoft')
@section('reiko-active', 'active')

@section('contenido')
  
<section id="reikocontenedor">
    
    <div id="infosystem">
        @if(isset($user))
            @if (isset($user->foto))
                <img src="{{ route('recursos.show', ['img/perfiles', $user->foto]) }}" alt="" width="40px" height="40px" >
            @else
                <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt="" width="40px" height="40px" >
            @endif
            @if (isset($user->typeUser->descripcion))
                <p>Perfil: {{ $user->typeUser->descripcion }} -</p>
                
            @endif

            <p>{{ $user->name }}</p>
            <!-- Puedes mostrar otros atributos del usuario aquí -->
        @else
            <p>No hay información de usuario disponible.</p>
        @endif
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
                
    </div>
    <div id="contenedormodulos">
        <button class="prevbuttonmenu" id="prevButton">&#8249;</button>
        <div id="modulos">
            
            <a href="{{ route('posts.index') }}">
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


@endsection