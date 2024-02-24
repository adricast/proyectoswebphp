
@extends('estructura.cabecera')

@section('titulo', 'registrousuario')
@section('registeruser-active', 'active')

@section('contenido')
<main class="main">
 
        <div class="contenido">
         
            <div class="titulo">
                <h1>Ingreso al Sistema</h1>
            </div>
            <div class="seccion">
                
               
                <h2><img src="{{ route('recursos.show', ['img', 'logotype.png']) }}" alt="" width="40px" height="40px" >
           </h2>
                <form action="{{route('login')}}" method="post" novalidate>
                @csrf
              

                    <input type="user" placeholder="Ingresa el usuario" id="usuario" name="name" class="@error('name') border-red-500 @enderror" value="" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror

                    <input type="password" placeholder="Ingresa contraseña" id="password" name="password" class="@error('password') border-red-500 @enderror" required>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                    <div class="elementoformbtn" style="display:flex;" >
                        <label for="remembercheck" style="margin-right:10px;">Recordar</label>
                        <input type="checkbox" name="remember" id="remembercheck">
                        
                    </div>
                 
                  
                    @if (session('mensaje'))
                    <div class="alert alert-success" role="alert">
                        {{session('mensaje')}}
                    </div>
                    
                    @endif
                    <input type="submit" value="Ingresar">
                </form>
              
                <a href="{{route('register') }}"> Crear usuario </a>

            </div>
        </div>

     
</main>
@endsection
