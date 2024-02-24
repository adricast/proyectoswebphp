@extends('estructura.cabecera')

@section('titulo', 'Inicio')
@section('inicio-active', 'active')

@section('contenido')
   
    @include('contenidos.introservicio')
    @include('contenidos.solucionestecnologicas')
    @include('contenidos.pie')
@endsection
