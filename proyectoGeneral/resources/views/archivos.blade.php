@extends('layouts.app')

@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
@endsection


@section('content')
<section class="fondo">
    <section class="fondo2">
        <nav class="navAdmin">
            <a href="{{url('home/visualizarArchivos')}}"><img src="{{ asset('imgs/vision1.png')}}">Visualizar Archivos</a>
            <a style="background: white; color: #000000;font-weight: 800;" href="{{url('home/archivos')}}">
            <img src="{{ asset('imgs/sub2.png')}}">Cargar Datos</a>
            <a href="{{url('home/metricas')}}"><img src="{{ asset('imgs/metrica1.png')}}">Métricas</a>
            <a href="{{url('home/gestionUsuarios')}}"><img src="{{ asset('imgs/group.png')}}">Gestionar Usuarios</a>
        </nav>
        

        <section class="espacioCA">
            <h3><img style="padding-right: 0.5em;"  src="{{ asset('imgs/carga.png')}}">CARGA DE ARCHIVOS A LA BASE DE DATOS</h3>
            <div class="card mt-4">
                <div class="card-header">
                    Importación de archivos a la base de datos
                </div>
               @if ($errors->any())
                    
                    @foreach ($errors->all() as $error)
                        <!-- <li>{{ $error }}</li>-->
                        <script>
                            var texto = "";
                            var cadena = '{{$error}}'.split('/')
                            for (let i = 1; i < cadena.length; i++) {

                                texto += cadena[i]+"\n";
                                
                            }
                            
                            swal({
                                title: cadena[0],
                                text: texto,
                                icon: "error",
                                button: "OK",
                                });
                        </script> 
                    @endforeach
                @endif

                @if($message = Session::get('success'))
                    <script>swal("{!! Session::get('success')!!}",'success')</script>
                @endif
                <div class="card-body">
                    <form action="{{ url('import-excel') }}" method="POST" name="importform" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="import_file[]" class="form-control" multiple>
                        <br>
                        <button class="btn btn-success" name="opcion" value="1">Importar archivo</button>
                        <button class="btn text-white" style="background:#1a135a" name="opcion" value="2">Probar archivo</button>
                    </form>
                </div>
                

            </div>

        </section>
        
        <section class="col-6">
            @if($message = Session::get('eliminado'))
                <script>swal("{!! $message !!}",'success')</script>
            @endif
        </section>
        

       <!-- Tabla de Archivos-->
       <section class="section-archivos">
                <h4><img style="padding-right: 1em;"  src="{{ asset('imgs/lista.png')}}">LISTA DE ARCHIVOS</h4>

        </section>
        <div class="row justify-content-left "> 
            <div class="cardCargaAr justify-content-left" >
                
                <div class="card-body">
                    <table class="table table-striped tablaAr" id='t_archivos' >
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Fecha de carga</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td>{{$file->nombre}}</td>
                                    <td>{{$file->created_at}}</td>
                                    <td>
                                        <a href="../storage/{{$file->nombre}}" class="btn btn-sm btn-outline-secondary">Ver</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger btnEliminar" data-id="{{ $file->id }}" data-toggle="modal" data-target="#modalEliminar">
                                            Eliminar
                                        </button>
                                        
                                        <form action="{{ url('home/archivos', $file->id ) }}" method="POST" id="formEli_{{ $file->id }}">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $file->id }}">
                                            <input type="hidden" name="_method" value="delete">
                                        
                                        </form>
                                        
                                    </td>
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    

        <!-- Modal Eliminar Archivos-->
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Archivo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                        <div class="modal-body">
                            <h5>¿Desea Eliminar el Archivo?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger btnModalEliminar">Eliminar</button>
                        </div>
                    
                </div>
            </div>
        </div>

    </section>
</section>
    
@endsection

@section('scripts') 
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>    
    <script>
        $('#t_archivos').DataTable({
            responsive:true,
            autowidth:false,
            dom: 'Blfrtip',
     
            
            buttons: [
                   
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

    
    <script>
        var idEliminar=0;
        $(document).ready(function(){

            $(".btnEliminar").click(function(){
                idEliminar = $(this).data('id');
            });
            $(".btnModalEliminar").click(function(){
                $("#formEli_"+idEliminar).submit();
            });
        });
    </script>



@endsection