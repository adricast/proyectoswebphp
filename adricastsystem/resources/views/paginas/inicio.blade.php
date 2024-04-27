@extends('estructura.cabecera')

@section('titulo', 'Inicio')
@section('inicio-active', 'active')

@section('contenido')
   
    @include('contenidos.introservicio')
    @include('contenidos.procesosdeservicio')
    @include('contenidos.pie')
@endsection
