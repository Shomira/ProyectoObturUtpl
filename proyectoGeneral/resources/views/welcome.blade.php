@extends('layouts.app')

@section('content')

    <section class="containerSlider">
    <!--inicia el slider-->
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="{{ asset('imgs/Buss2Slider.png')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="{{ asset('imgs/img2SliderT2.png')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
                </div>
                
                <div class="carousel-item">
                <img src="{{ asset('imgs/destSlider.png')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="{{ asset('imgs/Buss1Slider.png')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="{{ asset('imgs/mapCarSlider.png')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="{{ asset('imgs/img1SliderT1.png')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="{{ asset('imgs/mapPlaneSlider.png')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <section class="datosEstab">
            <h2>DATOS ESTABLECIMIENTO</h2>
            <article class="datEs">    
                <img src="{{ asset('imgs/velocidad.png')}}">
                <div class="hoverDe">
                    <h4>Categoria</h4>
                </div> 
            </article >
            <article class="datEs">    
                    <img src="{{ asset('imgs/cargar.png')}}">
                    <div class="hoverDe">
                        <h4>Tarifa Promedio</h4>
                    </div>
            </article >
            <article class="datEs">    
                    <img src="{{ asset('imgs/vendedor.png')}}">
                    <div class="hoverDe">
                        <h4>Porcentaje de Ocupación</h4>
                    </div>
            </article>
        </section>
   
     
        <section class="serviciosL">
            <h2>SERVICIOS GENERALES</h2>
            <article class="servicios">    
                    <img src="{{ asset('imgs/hotel.png')}}">
                    <h4>Residencia</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam error voluptatibus rerum quam, 
                        at qui laboriosam explicabo debitis odit esse alias obcaecati? Dignissimos dolor commodi aspernatur 
                        eligendi quidem totam dicta!</p>
            </article >
            <article class="servicios">    
                    <img src="{{ asset('imgs/plato.png')}}">
                    <h4>Restaurantes</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam error voluptatibus rerum quam, 
                        at qui laboriosam explicabo debitis odit esse alias obcaecati? Dignissimos dolor commodi aspernatur 
                        eligendi quidem totam dicta!</p>
            </article >
            <article class="servicios">    
                    <img src="{{ asset('imgs/lugar.png')}}">
                    <h4>Sitios</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam error voluptatibus rerum quam, 
                        at qui laboriosam explicabo debitis odit esse alias obcaecati? Dignissimos dolor commodi aspernatur 
                        eligendi quidem totam dicta!</p>
            </article >
        </section>
        <section class="serviciosL2">
            <h2 >SERVICIOS DE HOTELES</h2>
            <article style="background-color: rgba(238, 230, 118, 0.466)" class="servicios">    
                    <img style="width: 45%; "src="{{ asset('imgs/redess.png')}}">
                    <h4 style="color:#1b0ba8;">Acceso a Wifi</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam error voluptatibus rerum quam, 
                        at qui laboriosam explicabo debitis odit esse alias obcaecati? Dignissimos dolor commodi aspernatur 
                        eligendi quidem totam dicta!</p>
            </article >
            <article style="background-color: rgba(238, 230, 118, 0.466)" class="servicios">    
                    <img src="{{ asset('imgs/dormitorio.png')}}">
                    <h4 style="color:#1b0ba8;">Servicios de Habitación</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam error voluptatibus rerum quam, 
                        at qui laboriosam explicabo debitis odit esse alias obcaecati? Dignissimos dolor commodi aspernatur 
                        eligendi quidem totam dicta!</p>
            </article >
            <article  style="background-color: rgba(238, 230, 118, 0.466)" class="servicios">    
                    <img src="{{ asset('imgs/promocion.png')}}">
                    <h4 style="color:#1b0ba8;">Promociones</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam error voluptatibus rerum quam, 
                        at qui laboriosam explicabo debitis odit esse alias obcaecati? Dignissimos dolor commodi aspernatur 
                        eligendi quidem totam dicta!</p>
            </article >
        </section>

        
        <section class="sitiosLoja">
            <h2>DESCUBRE EN LA PROVINCIA DE LOJA</h2>
            <article class="sitios">    
                    <img src="{{ asset('imgs/img1Hom.png')}}">
                    <h4>Eventos</h4>
            </article >
            <article class="sitios" >
                    <img src="{{ asset('imgs/img2Hom.png')}}">
                    <h4>Plazas</h4>
            </article >
            <article class="sitios">
                    <img  src="{{ asset('imgs/img3Hom.png')}}">
                    <h4>Atractivos</h4>
            </article >
            <article class="sitios" >
                    <img  src="{{ asset('imgs/img4Hom.png')}}">
                    <h4>Parques</h4>
            </article>
        </section>
        
        <section class="map">
            <h2>Ubicación</h2>

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63680.998371727175!2d-79.2433984719824!3d-4.007594453866496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91cb480661b91d2d%3A0x8e12137cdc1eee09!2sLoja!5e0!3m2!1ses!2sec!4v1608711364387!5m2!1ses!2sec" width="1515" height="500" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </section>
        <script>
            var myCarousel = document.querySelector('#myCarousel')
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 1000,
                wrap: false
            })
        </script>

    </section>


    

   
@endsection

@section('pieDePagina')
    @include('layouts.footer')
@endsection
