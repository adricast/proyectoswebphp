@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'modulosreiko.js']) }}"></script>
 
    <section class="containerreiko">
       
        <div class="contenedormodulos">
            <a href="{{ route('cmodulos.create') }}">
                <div class="target">
                        
                        <img src="{{ route('recursos.show',['img/modulos', 'mas.png']) }}" alt="Ventas">
                        <p>Nuevo Modulo </p>
                </div>
            </a>
            <a href="{{ route('posts.index') }}">
                <div class="target">
                    
                    <img src="{{ route('recursos.show',['img/modulos', 'home.png']) }}" alt="Ventas">
                    <p>HOME</p>
                </div>
            </a>
            <a href="{{ route('cmodulos.index') }}">
                <div class="target">
                    
                    <img src="{{ route('recursos.show',['img/modulos', 'modulos.png']) }}" alt="Ventas">
                    <p>MODULOS</p>
                   
                </div>
            </a>
            @foreach ($modulos as $modulo)
                @if (Route::has($modulo->ruta.'.index'))
                <a  ondblclick="redirigir('{{ $modulo->ruta }}') ">
                    <div class="target">
                    <img src="{{ asset('img/modulos/' . $modulo->icono) }}" alt="{{ $modulo->icono }}">
                    <p>{{ $modulo->nombre }}</p>
                        <div class="botones">
                            {{-- Botón Eliminar --}}
                            <button onclick="eliminarDatos('{{ $modulo->id }}')">
                                <i class="fas fa-trash"></i> 
                            </button>

                            {{-- Botón Modificar --}}
                            <button class="btneditar" onclick="modificarDatos('{{ $modulo->id }}')">
                                <span class="fa fa-edit"></span>
                            </button>
                            
                        </div>
                    </div>
                </a>
                @else
                <a href="#">
                    
                    <div class="target" >
                    <img src="{{ asset('img/modulos/'. $modulo->icono) }}" alt="Imagen Perfil">
                    <p>{{ $modulo->nombre }}</p>
                        
                        <div class="botones">
                            {{-- Botón Eliminar --}}
                            <button onclick="eliminarDatos('{{ $modulo->id }}')">
                                <i class="fas fa-trash"></i> 
                            </button>

                            {{-- Botón Modificar --}}
                            <button class="btneditar" onclick="modificarDatos('{{ $modulo->id }}')">
                                <span class="fa fa-edit"></span>
                            </button>
                            
                        </div>
                    </div>
                </a>
  
                @endif
             @endforeach

           
        </div>
     
    </section>
    
    @include('reikosoft.modulos.edit') 

@endsection
   