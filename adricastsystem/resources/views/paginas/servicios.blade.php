@extends('estructura.cabecera')

@section('titulo', 'Nosotros')
@section('nosotros-active', 'active')

@section('contenido')
    @include('contenidos.introservicio')
    @include('contenidos.infoservicio')
    @include('contenidos.solucionestecnologicas')
    @include('contenidos.pie')
@endsection
