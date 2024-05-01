@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'categoriasreiko.js']) }}"></script>
    <button type="button" id="btnEliminarSeleccionados" style="display: none;" class="btn" onclick="eliminarDatos(obtenerCategoriasSeleccionadas())">Eliminar seleccionados</button>
 
    Busqueda
    <input type="text" name="busqueda" id="busqueda" placeholder="Busqueda de Datos" onkeyup="consultaDatos()" style="width: 200px;">
      
    <section class="containerreiko">
       
        <div class="contenedormodulos" id="contenedorelemento">
            <a href="{{ route('categorias.create') }}">
                <div class="target">
                        
                        <img src="{{ route('recursos.show',['img/categorias', 'mas.png']) }}" alt="Ventas">
                        <p>Nueva Categoria </p>
                </div>
            </a>
            
            @foreach ($categorias as $categoria)
                <a>
                    <div class="target">
                    @if ($categoria->foto)
                        <img src="{{ asset('img/categorias/' . $categoria->foto) }}" alt="{{ $categoria->foto }}">
                    @else
                            <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt=""  height="150px" width="150px">
                    @endif
                      <p>{{ $categoria->nombre }}</p>
                        <div class="botones">
                            {{-- Checkbox --}}
                            <input type="checkbox" name="categorias_seleccionadas[]" value="{{ $categoria->id }}" onchange="actualizarVisibilidadBotonEliminar()">
                            
                            {{-- Botón Eliminar --}}
                            <button onclick="eliminarDatos('{{ $categoria->id }}')">
                                <i class="fas fa-trash"></i> 
                            </button>

                            {{-- Botón Modificar --}}
                            <button class="btneditar" onclick="modificarDatos('{{ $categoria->id }}')">
                                <span class="fa fa-edit"></span>
                            </button>
                            
                        </div>
                    </div>
                </a>
                @endforeach

           
        </div>
     
    </section>
    
    @include('reikosoft.categorias.edit') 

@endsection
   