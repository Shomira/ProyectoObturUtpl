@extends('layouts.app')

@section('content')
<section class="fondo">
    <section class="fondo2">
        <nav class="navAdmin">
            <a href="{{url('home/visualizarArchivos')}}"><img src="{{ asset('imgs/vision1.png')}}">Visualizar Archivos</a>
            <a href="{{url('home/archivos')}}"><img src="{{ asset('imgs/sub2.png')}}">Cargar Datos</a>
            <a style="background: white; color: #000000;font-weight: 800;" href="{{url('home/metricas')}}">
            <img src="{{ asset('imgs/metrica1.png')}}">Métricas</a>
            <a href="{{url('home/gestionUsuarios')}}"><img src="{{ asset('imgs/group.png')}}">Gestionar Usuarios</a>
        </nav>
        
        <section class="espacio">

        </section>
    </section>
</section>
@endsection