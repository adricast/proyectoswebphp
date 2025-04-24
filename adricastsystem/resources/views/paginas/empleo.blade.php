@extends('estructura.cabecera')

@section('titulo', 'Trabaja con nosotros')
@section('empleo-active', 'active')

@section('contenido')
    
    @include('contenidos.ofertaempleo')
    @include('contenidos.formaempleo')
    @include('contenidos.introtecnologias')
    @include('contenidos.pie')
@endsection