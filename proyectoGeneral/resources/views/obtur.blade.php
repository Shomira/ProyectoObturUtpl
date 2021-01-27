@extends('layouts.app')

@section('content')
<section class="contObtur">
<h1 style="padding:0.2em 1em;">EQUIPO DE TRABAJO</h1>
    <article class="quienesSomosO">
        <img src="{{ asset('imgs/team.jpg')}}" alt="...">
        <p></p>
    </article>
    <article class="quienesSomosO">
        <p style="font-size:18px;">
        El Observatorio Turístico es una iniciativa que se crea con el objetivo principal de apoyar el desarrollo de la 
        industria turística que busca fomentar prácticas de turismo sostenible y elevar la competitividad del destino en base a
         información fiable y comprobada.A través de a construcción de una base de series estadísticas se pretende establecer 
         un marco de referencia para el análisis sistemático de la situación real y tendencias de la industria turística, 
         facilitando así, la toma de decisiones de los empresarios y representantes de entidades gubernamentales, 
         al mismo tiempo que da seguimiento al impacto que las políticas públicas y planes de gestión relacionados con el desarrollo del
          destino pudiesen tener sobre la mencionada industria.
        <br></br>
        
        <strong>Datos que colecta:</strong> indicadores de alojamiento, perfil del visitante, gasto turístico, motivación del viaje, nivel de satisfacción del turista.
        <br></br><strong>Alcance geográfico:</strong> Región sur del Ecuador <br></br>
        <strong>Herramientas TIC:</strong> Visor en la plataforma web y aplicativos para la oferta turística.
        </p>
    </article>
</section>


@endsection

@section('pieDePagina')
    @include('layouts.footer')
@endsection