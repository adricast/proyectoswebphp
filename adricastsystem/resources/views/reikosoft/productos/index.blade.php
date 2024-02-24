@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'productosreiko.js']) }}"></script>
    Busqueda
    <input type="text" name="busqueda" id="busqueda" placeholder="Busqueda de Datos" onkeyup="consultaDatos()" style="width: 200px;">
      
    <section class="containerreiko">
       
        <div class="contenedormodulos" id="contenedorelemento">
            <a href="{{ route('productos.create') }}">
                <div class="target">
                        
                        <img src="{{ route('recursos.show',['img/productos', 'mas.png']) }}" alt="Ventas">
                        <p>Nuevo Producto </p>
                </div>
            </a>
          
          
            @foreach ($productos as $producto)
                <a>
                    <div class="target">
                    @if ($producto->foto)
                            <img src="{{ route('recursos.show', ['img/productos', $producto->foto]) }}"  alt=""  height="150px" width="150px">
                    @else
                    <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt=""  height="150px" width="150px">
                     @endif
                    <p>{{ $producto->nombre}}</p>
                        <div class="botones">
                            {{-- Botón Eliminar --}}
                            <button onclick="eliminarDatos('{{ $producto->id }}')">
                                <i class="fas fa-trash"></i> 
                            </button>

                            {{-- Botón Modificar --}}
                            <button class="btneditar" onclick="modificarDatos('{{ $producto->id }}')">
                                <span class="fa fa-edit"></span>
                            </button>
                            
                        </div>
                    </div>
                </a>
              
               
             @endforeach

           
        </div>
     
    </section>
    
    @include('reikosoft.productos.edit') 

@endsection
   