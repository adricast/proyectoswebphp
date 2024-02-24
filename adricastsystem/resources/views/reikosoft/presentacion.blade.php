@extends('reikosoft.contenedor.contenedor')

@section('titulo', 'ReikoSoft')
@section('reikosoft-active', 'active')

@section('contenidoreiko')
    <section class="containerreiko">
        
        <img src="{{ route('recursos.show', ['img', 'fondoreiko.png']) }}" alt="">
    </section>
   
@endsection