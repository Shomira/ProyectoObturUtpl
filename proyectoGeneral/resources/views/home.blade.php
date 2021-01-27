@extends('layouts.app')

@section('content')

    @if(Auth::user()->rol == 'Administrador')
    <section class="fondo">
        <section class="fondo2">
            <nav class="navAdmin">
                <a href="{{url('home/visualizarArchivos')}}"><img src="{{ asset('imgs/vision1.png')}}">Visualizar Archivos</a>
                <a href="{{url('home/archivos')}}"><img src="{{ asset('imgs/sub2.png')}}"> Cargar Datos</a>
                <a href="{{url('home/metricas')}}"><img src="{{ asset('imgs/metrica1.png')}}">Métricas</a>
                <a href="{{url('home/gestionUsuarios')}}"><img src="{{ asset('imgs/group.png')}}">Gestionar Usuarios</a>
                
            </nav>
            <section class="espacioAdmin">
                <h2><img style="margin-right: 0.5em;" src="{{ asset('imgs/adminv.png')}}">Bienvenid@ {{ Auth::user()->name }}</h2>
                  
                <section class="datosAd">
                    <article class="datAd">
                        <section class="partsup"  ><h5>Visualizar Archivos</h5></section>   
                        <p> <img src="{{ asset('imgs/verArchivos.png')}}"> Permite acceder a los registros y filtrarlos por fecha</p>
                    </article >     
                    <article class="datAd">
                            <section class="partsup" style="background: rgb(255,114,74)" ><h5>Cargar Datos:</h5></section>  
                                <p> <img src="{{ asset('imgs/cargarDatos.png')}}">Cumple la funcion de cargar los registros mediante la carga de archivos.csv</p>
                    </article >
                    <article class="datAd">
                            <section class="partsup" style="background: rgb(255,114,74)"><h5>Métricas</h5></section>  
                            <p><img src="{{ asset('imgs/metricas.png')}}"> Crea gráficas estadisticas mediante el uso de filtros.</p>
                    </article>
                    <article class="datAd">
                            <section class="partsup" ><h5>Gestionar Usuarios</h5></section>    
                            <p><img src="{{ asset('imgs/gestionarUsuarios.png')}}">Muestra una lista de usuarios con las opciones: editar, eliminar y crear.</p>
                    </article>
                </section>                
            </section>

        </section>
    </section>

    <!--Parte del Usuario del Establecimiento-->
    @endif
    @if(Auth::user()->rol == 'Establecimiento')
    <section class="fondo">
        <section class="fondo2">
            <nav class="navAdmin">
                <a  href="{{url('home/visualizarGraficas')}}"><img src="{{ asset('imgs/metrica1.png')}}">Visualizar Gráficas</a>
                <a href="{{url('home/visualizarRegistros')}}"><img src="{{ asset('imgs/vision1.png')}}"> Visualizar Registros</a>                
            </nav>
        
            <section class="espacioAdmin">
                <h2><img style="margin-right: 0.5em;" src="{{ asset('imgs/adminv.png')}}">Bienvenid@ {{ Auth::user()->name }}</h2>
                  
                <section class="datosAd">
                    <article class="datAd">
                        <section class="partsup"  ><h5>Visualizar Archivos</h5></section>   
                        <p> <img src="{{ asset('imgs/verArchivos.png')}}"></p>
                    </article >     
                    <article class="datAd">
                            <section class="partsup" style="background: rgb(255,114,74)" ><h5>Ver Estadísticas</h5></section>  
                                <p> <img src="{{ asset('imgs/cargarDatos.png')}}"></p>
                    </article >
                    
            </section>                
        </section>

    </section>

    @endif

@endsection
