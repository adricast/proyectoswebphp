@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'rolesusuariosreiko.js']) }}"></script>
  
    <div class="contenedorbusqueda">
        Busqueda
        <input type="text" name="busqueda" id="busqueda" placeholder="Ingrese el Codigo del Usuario"  style="width: 200px;">
        <input type="button" value="buscar"  onclick="consultaUsuario()">
    </div>
   
    <section class="containerreiko2">
        <div class="containerelemento">
            <div class="elemento1">
                <label for="codigo">Codigo</label>
                <input type="text" name="codigo" id="codigo" readonly>
            </div>
            <div class="elemento2">
                <label for="nombre">Nombres</label>
                <input type="text" name="nombre" id="nombre" readonly>
            </div>
            <div class="elemento3">
                <label for="descripcion">UserName</label>
                <input type="text" name="username" id="username" readonly>
            </div>
            <div class="elemento4">
                <label for="marca">Tipo Usuario</label>
                <input type="text" name="marca" id="marca" readonly>
            </div>
        </div>
        <div class="contenedorcaracteristicas" id="contenedorcaracteristicas">
            <!-- Aquí se generará dinámicamente el contenido de las características -->
        </div>
              
        
       
        
       
    </section>
    
   

@endsection