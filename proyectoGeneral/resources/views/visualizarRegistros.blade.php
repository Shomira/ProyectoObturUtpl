@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
@endsection

@section('content')
<section class="fondo">
    <section class="fondo2">
        <nav class="navAdmin">
            <a href="{{url('home/visualizarGraficas')}}"><img src="{{ asset('imgs/metrica1.png')}}">Visualizar Gráficas</a>
            <a style="background: white; color: #000000;font-weight: 800;"  href="{{url('home/visualizarRegistros')}}"><img src="{{ asset('imgs/vision1.png')}}"> Visualizar Registros </a>                
        </nav>

        <section class="espacioVisualizarA">

            @isset ($alerta)
                <script>swal('No existen registros!','Aún no has subido archivos','warning')</script>
            @endisset

        <br>
            <div class="container principalV">
                <div class="row">
                    <div class="col-lg-12 text-left">
                        <div class="row">
                            <!--tarjeta 1-->
                            <div class="col-lg-30  col-md-8 mb-4">
                                <div class="card-section3 border rounded p-3">
                                    <div class="card-header-s rounded pb-4">
                                        <h5 class="card-header-title text-white pt-3">Registros</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--                -->
        
            <!-- Tabla de Registros-->
            <div class="container overflow-auto">
                
                <div class="form-row ">
                    <form action="{{url('home/visualizarRegistros')}}" method="POST" class="visualizarArchivo">
                    
                        <div class="form-row">
                            @csrf
                            <div class="col-md-5">
                                <p>Ver registros desde:</p>
                                <div class="input-group"> 
                                <input type="date" name="inicio" value="23/12/2020"  class="form-control" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" required>
                                </div>
                            </div>
                            <div class="col-md-5 ">
                                <p>Ver registros hasta:</p>
                                <div class="input-group">  
                                    <input type="date" name="fin" value="{{ old('fin') }}" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <br>
                                <button type="submit" class="btn btn-warning mt-3">Consultar</button>
                            </div>
                            
                        </div>
                        
                    </form>
                </div>

            <!-- Tabla de Registros-->
            <div class="container overflow-auto">
                
                <section class="linea2" ></section>
                <div class="row justify-content-center overflow-auto">
                    <!---->
                    <div class="card overflow-auto">
                        <div class="card-header overflow-auto"> {{$mensaje}}</div>
                        <div class="card-body overflow-auto">
                            <div class="table-responsive table-striped overflow-auto">
                                <table class="table col-12 table-responsive overflow-auto" id='t_registros'>
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Fecha</th>
                                            <th>Id Establecimiento</th>
                                            <th>Checkins</th>
                                            <th>Checkouts</th>
                                            <th>Pernoctaciones</th>
                                            <th>Nacionales</th>
                                            <th>Extranjeros</th>
                                            <th>Hab. Ocupadas</th>
                                            <th>Tarifa Prom.</th>
                                            <th>Ventas Netas</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($registros as $registro)
                                            <tr>
                                                <td>{{$registro->id}} </td>
                                                <td>{{$registro->fecha}}</td>
                                                <td>{{$registro->idEstablecimiento}}</td>
                                                <td>{{$registro->checkins}}</td>
                                                <td>{{$registro->checkouts}}</td>
                                                <td>{{$registro->pernoctaciones}}</td>
                                                <td>{{$registro->nacionales}}</td>
                                                <td>{{$registro->extranjeros}}</td>
                                                <td>{{$registro->habitaciones_ocupadas}}</td>
                                                <td>{{$registro->tarifa_promedio}}</td>
                                                <td>{{$registro->ventas_netas}}</td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </section>
</section>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>    
    <script>
         
        $('#t_registros').DataTable({
            responsive:true,
            autowidth:false,
            dom: 'Blfrtip',
            "lengthMenu": [ 5, 10, 20, 30, 50 ],
            
            buttons: [
                    'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
            "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "Nada encontrado - disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "Usuario no encontrado",
                    "infoFiltered": "(filtrado de _MAX_ usuarios totales)",
                    "search": "Buscar:",
                    "paginate": {    
                        "previous" : "Anterior",
                        "next": "Siguiente"   
                                },
                    "buttons":{"copy": "Copiar"}
            }
        });
    
    </script>
@endsection	