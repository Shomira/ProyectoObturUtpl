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
            <a  style="background: white;" class="a-sub-menu" href="{{url('home/visualizarArchivos')}}">
            <img src="{{ asset('imgs/vision1.png')}}">Visualizar Archivos</a>
            <a href="{{url('home/archivos')}}"><img src="{{ asset('imgs/sub2.png')}}">Cargar Datos</a>      
            <a href="{{url('home/metricas')}}"><img src="{{ asset('imgs/metrica1.png')}}">Métricas</a>
            <a href="{{url('home/gestionUsuarios')}}"><img src="{{ asset('imgs/group.png')}}">Gestionar Usuarios</a>
        </nav>
        @isset ($alerta)
            <script>swal('No existen registros!','Aún no has subido archivos','warning')</script>
        @endisset
           
            <!-- Tabla de Establecimientos-->
            <!--Pone la tabla en uin container-->
       
        <div class="containerTab">
            <div class="cardV">
                <div class="container principalV">
                    <div class="row">
                        <div class="col-lg-12 text-left">
                            <div class="row">
                                <!--tarjeta 1-->
                                <div class="col-lg-30  col-md-8 mb-4">
                                    <div class="card-section2 border rounded p-3">
                                        <div class="card-header-s rounded pb-4">
                                            <h5 class="card-header-title text-white pt-3">Establecimientos Existentes</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="card-body">
                    <table class="table table-striped" id='t_establecimientos'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Clasificación</th>
                                <th>Categoria</th>
                                <th>Habitaciones</th>
                                <th>Plazas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($establecimientos as $establecimiento)
                                <tr>
                                    <td>{{$establecimiento->id}} </td>
                                    <td>{{$establecimiento->nombre}}</td>
                                    <td>{{$establecimiento->clasificacion}}</td>
                                    <td>{{$establecimiento->categoria}}</td>
                                    <td>{{$establecimiento->habitaciones}}</td>
                                    <td>{{$establecimiento->plazas}}</td>
                                            
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <!-- Tabla de Registros-->  

        <div class="containerTab" >                    
            <div class="cardV">
                <!--panel de Filtros -->
                    <div class="container principalV">
                        <div class="row">
                            <div class="col-lg-12 text-left">
                                <div class="row">
                                    <!--tarjeta 1-->
                                    <div class="col-lg-30  col-md-8 mb-4">
                                        <div class="card-section border rounded p-3">
                                            <div class="card-header-s rounded pb-4">
                                                <h5 class="card-header-title text-white pt-3">Registros</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    <form action="{{url('home/visualizarArchivos')}}" method="POST" class="visualizarArchivo" >
                        @csrf                 
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputState">Elige un Establecimiento: </label>
                                <select id="inputState" class="form-control" name="nombre" required>
                                    <option value="" selected>--Elija un establecimiento--</option>
                                    @foreach($establecimientos as $establecimiento)
                                        <option value="{{$establecimiento->nombre}}">{{$establecimiento->nombre}}</option>
                                    @endforeach
                                    <option value="Todos">TODOS</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ver Registros desde:</label>
                                <input  type="date" name="inicio" value="23/12/2020"  class="form-control" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Ver registros hasta:</label>
                                <input type="date" name="fin" value="{{ old('fin') }}" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
                            </div>
                            <div class="form-group col-md-2">
                                <br>
                            <!-- <button type="submit" class="btn btn-primary" >Consultar</button>-->
                                <input type="submit"  class="btn btn-warning" value="Consultar">
                            </div>
                        </div>
                    </form>
                
                <section class="section-filtro">
                    <form>
                        <div class="row">
                            <div class="col">
                                <input type="text"  class="input-filtros" placeholder="" value="Hotel:" disabled >
                                <input type="text"  class="input-filtros1"  placeholder="{{$filtroEstabl}}" disabled>
                            </div>
                            
                            <div class="col">
                                <input type="text"  class="input-filtros" placeholder="" value="Desde: " disabled>
                                <input type="text"  class="input-filtros1"  placeholder="{{$desde}}" disabled>
                            </div>
                            <div class="col">
                                <input type="text"  class="input-filtros" placeholder="" value="Hasta: " disabled>
                                <input type="text"  class="input-filtros1"   placeholder="{{$hasta}}" disabled >
                            </div>
                        </div>
                    </form>
                    <section class="linea" ></section>
                </section>
            <section class="section-registros">
                <h4>RESULTADOS</h4>

            </section>
                
                <div class="card-body" >
                    <table  class="table table-striped" id='tabRegistros'>
                        <thead>
                            <tr>
                                <th>Establecimiento</th>
                                <th>Fecha</th>
                                <th>Checkins</th>
                                <th>Checkouts</th>
                                <th>Pernoctaciones</th>
                                <th>Nacionales</th>
                                <th>Extranjeros</th>
                                <th>Hab. Ocupadas</th>
                                <th>Hab. Disponibles</th>
                                <th>Ventas Netas</th>
                                <th>Empleados Temporales</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach($registros as $registro)
                            <tr>
                                <td>{{$registro->nombre}} </td>
                                <td>{{$registro->fecha}}</td>
                                <td>{{$registro->checkins}}</td>
                                <td>{{$registro->checkouts}}</td>
                                <td>{{$registro->pernoctaciones}}</td>
                                <td>{{$registro->nacionales}}</td>
                                <td>{{$registro->extranjeros}}</td>
                                <td>{{$registro->habitaciones_ocupadas}}</td>
                                <td>{{$registro->habitaciones_disponibles}}</td>
                                <td>{{$registro->ventas_netas}}</td>
                                <td>{{$registro->empleados_temporales}}</td>
                                <td>{{$registro->estado}}</td>
                                <td>{{$registro->opciones}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
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
        $('#t_establecimientos').DataTable({
            responsive:true,
            autowidth:false,
            dom: 'Blfrtip',
            "lengthMenu": [ 5, 10, 20, 30, 50 ],
            
            buttons: [
                      
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
        $('#tabRegistros').DataTable({
            responsive:true,
            autowidth:false,
            dom: 'Blfrtip',
           
            buttons: [
                
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
