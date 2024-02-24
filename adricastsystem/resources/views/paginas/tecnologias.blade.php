@extends('estructura.cabecera')

@section('titulo', 'Tecnologías')
@section('tecnologias-active', 'active')

@section('contenido')
    @include('contenidos.introtecnologias')
    @include('contenidos.pie')
@endsection
