@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')

    <script src="{{ route('recursos.show', ['js/reiko', 'perfilesreiko.js']) }}"></script>
  
    <section class="containerreiko">
       
       <div class="contenedorformulario">
            <form action="{{route('perfiles.update')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                @if ($user->foto)
                            <img src="{{ route('recursos.show', ['img/perfiles', $user->foto]) }}"  alt="" id="imagen-preview" height="150px" width="150px">
                @else
                            <img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt="" id="imagen-preview" height="150px" width="150px">
                @endif
                <input type="file" name="imagenmodulo" id="file-input" onchange="cargarImagen()">
                <button class="btn" type="button" id="quitarImagen" style="display: none;" onclick="quitarImg()">Quitar Imagen</button>
                
                @if(isset($user))
                    <p>{{ $user->nombres . " " . $user->apellidos }} </p>
                    @if(isset($user->typeUser))
                        <p>{{ $user->username . " - " . $user->typeUser->descripcion }}</p>
                    @endif
                @endif
                <input type="text" name="email" id="email" value="{{ $user->email }} " placeholder="ingresa su email">
                <input type="text" name="telefono" id="telefono" value="{{ $user->telefono }} " placeholder="ingresa su telefono">
                <input type="text" name="direccion" id="direccion" value="{{ $user->direccion }} " placeholder="ingresa su direccion">
                <p>Opcional si deseas cambiar contraseña </p>
                <input type="password" name="nuevacontraseña" id="nuevacontraseña"  placeholder="escribir nueva contraseña">
                <p>Confirma con tu contraseña para modificar tus datos</p>
                <input type="password" name="contraseña" id="contraseña"  placeholder="escribir nueva contraseña">
                <button type="submit" id="modificarbtn" onclick="event.preventDefault(); actualizarDatos();">Modificar</button>
              
            
            </form>
       </div>
           
        
    
    </section>
 

@endsection
   