@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'marcasreiko.js']) }}"></script>
    Busqueda
    <input type="text" name="busqueda" id="busqueda" placeholder="Busqueda de Datos" onkeyup="consultaDatos()" style="width: 200px;">
   
    <section class="containerreiko">
       
        <div class="contenedormodulos" id="contenedorelemento">
            <a href="{{ route('marcas.create') }}">
                <div class="target">
                        
                        <img src="{{ route('recursos.show',['img/marcas', 'mas.png']) }}" alt="Ventas">
                        <p>Nueva Marca </p>
                </div>
            </a>
            
            @foreach ($marcas as $marca)
                <a>
                    <div class="target">
                    @if ($marca->foto)
                        <img src="{{ asset('img/marcas/' . $marca->foto) }}" alt="{{ $marca->foto }}">
                    @else
                            <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt=""  height="150px" width="150px">
                    @endif
                      <p>{{ $marca->nombre }}</p>
                        <div class="botones">
                            {{-- Botón Eliminar --}}
                            <button onclick="eliminarDatos('{{ $marca->id }}')">
                                <i class="fas fa-trash"></i> 
                            </button>

                            {{-- Botón Modificar --}}
                            <button class="btneditar" onclick="modificarDatos('{{ $marca->id }}')">
                                <span class="fa fa-edit"></span>
                            </button>
                            
                        </div>
                    </div>
                </a>
                @endforeach

           
        </div>
     
    </section>
    
    @include('reikosoft.marcas.edit') 

@endsection
   