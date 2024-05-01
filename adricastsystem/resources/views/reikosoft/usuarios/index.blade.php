@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'usuariosreiko.js']) }}"></script>
    <button type="button" id="btnEliminarSeleccionados" style="display: none;" class="btn" onclick="eliminarDatos(obtenerUsuariosSeleccionados())">Eliminar seleccionados</button>
 
    Busqueda
    <input type="text" name="busqueda" id="busqueda" placeholder="Busqueda de Datos" onkeyup="consultaDatos()" style="width: 200px;">
             
    <section class="containerreiko">
           
        <div class="contenedormodulos" id="contenedorelemento">
            <a href="{{ route('usuarios.create') }}">
                <div class="target">
                        
                        <img src="{{ route('recursos.show',['img/perfiles', 'mas.png']) }}" alt="Ventas">
                        <p>Nuevo Usuario </p>
                </div>
            </a>
           
            @foreach ($usuarios as $usuario)
                <a>
                    <div class="target">
                    @if ($usuario->foto )
                        <img src="{{ asset('img/perfiles/' . $usuario->foto) }}" alt="{{ $usuario->username }}">
                        <!--<img src="{{ asset('../../img/perfiles/' . $usuario->foto) }}" alt="{{ $usuario->username }}">
                        --><!-- APLICAR CUANDO CAMBIE A PRODUCCION-->
                    @else   
                        <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt=""  height="150px" width="150px">
                  
                    @endif
                     <p>{{ $usuario->username}}</p>
                        <div class="botones">
                            {{-- Checkbox --}}
                            <input type="checkbox" name="usuarios_seleccionados[]" value="{{ $usuario->id }}" onchange="actualizarVisibilidadBotonEliminar()">
                          
                            {{-- Botón Eliminar --}}
                            <button onclick="eliminarDato('{{ $usuario->id }}')">
                                <i class="fas fa-trash"></i> 
                            </button>

                            {{-- Botón Modificar --}}
                            <button class="btneditar" onclick="modificarDatos('{{ $usuario->id }}')">
                                <span class="fa fa-edit"></span>
                            </button>
                            
                        </div>
                    </div>
                </a>
              
               
             @endforeach

           
        </div>
     
    </section>
    
    @include('reikosoft.usuarios.edit') 

@endsection
   