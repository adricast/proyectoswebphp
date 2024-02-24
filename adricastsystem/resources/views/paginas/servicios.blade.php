@extends('estructura.cabecera')

@section('titulo', 'Nosotros')
@section('nosotros-active', 'active')

@section('contenido')
    @include('contenidos.introservicio')
    @include('contenidos.procesosdeservicio')
    @include('contenidos.infoservicio')
    @include('contenidos.pie')
@endsection
