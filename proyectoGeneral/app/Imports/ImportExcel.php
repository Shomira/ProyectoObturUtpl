<?php

namespace App\Imports;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Establecimiento;
use Illuminate\Support\Facades\Validator;
use App\Models\Registro;


class ImportExcel implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

        foreach($collection as $key=>$value){
            
            if($key>0)
            {
                // Validamos si existe un usuario que enlazar con el archivo cargado
                Validator::make($value->toArray(), [
                    '0' => 'exists:App\Models\User,name'
                ],$messages = [
                    'exists' => 'No existe  un usuario relacionado al archivo que desea cargar'
                ])->validate();

                // buscamos un establecimiento que corresponda al del archivo cargado
                $idE=DB::table('establecimientos')
                ->select('id')
                ->where('nombre','=', $value[0] )
                ->get();
                // usamos una condicion para determinar si hubo o no un establecimiento para este registro
                if(empty($idE[0]->id) ){
                    $clave=0;
                }else{
                    $clave = $idE[0]->id;
                }
                
                // en caso de que no hubo establecimiento para el archivo a cargar, creamos uno a partir de los datos del archivo
                if($clave == 0){
                    
                    $idU=DB::table('users')
                        ->select('id')
                        ->where('name','=', $value[0] )
                        ->get();
                    
                    
                    DB::table('establecimientos')->insert(['nombre'=> $value[0],'clasificacion'=>$value[1],'categoria'=>$value[2],
                        'habitaciones'=>$value[3],'plazas'=>$value[4],'idUsuario'=> $idU[0]->id ]);
                    
                    $aux=DB::table('establecimientos')
                                ->select('id')
                                ->where('nombre','=', $value[0] )
                                ->get();
                    $clave = $aux[0]->id;
                }

                //Obtenemos el id del Archivo cargado
                $idArchivo = DB::select("SELECT Max(id) as 'id' FROM archivos ");

                //calculo de Ventas Netas
                if(!is_numeric($value[16])){
                    $ventasNetas = round(($value[11] * $value[14]),2);
                }else{
                    $ventasNetas = $value[16];
                }

                //calculo del TAR PER
                if($value[8] != 0){
                    $tarPer = round(($ventasNetas/$value[8]),2);
                }else{
                    $tarPer = 0;
                }
                //calculo de la tarifa promedio
                if($value[11] != 0){
                    $tarifaProm = round(($ventasNetas/$value[11]),2);
                }else{
                    $tarifaProm = 0;
                }
                //calculo del porcentaje ocupacion y revpar
                if($value[12] != 0){
                    $procentajeOcupacion = round(($value[11]/$value[12]),2);
                    $revpar =  round(($ventasNetas/$value[12]),2);
                }else{
                    $procentajeOcupacion = 0;
                    $revpar = 0;
                }
                

                // separamos los valores que nos vinieron en fecha para validarlos 
                $fechaux = explode('/', $value[5]);

                if(count($fechaux) == 3){
                    //creamos nuestro valor de fecha amigable con la base de datos
                    $fecha = $fechaux[2]."-".$fechaux[1]."-".$fechaux[0];

                    //determinar copias de registros +
                    $copia=DB::table('registros')
                        ->select('id', 'fecha', 'checkins','checkouts', 'pernoctaciones', 'nacionales')
                        ->where('fecha','=', $fecha)
                        ->where('checkins','=', $value[6] )
                        ->where('checkouts','=', $value[7] )
                        ->where('pernoctaciones','=', $value[8] )
                        ->where('nacionales','=', $value[9] )
                        ->where('extranjeros','=', $value[10] )
                        ->where('habitaciones_ocupadas','=', $value[11] )
                        ->where('habitaciones_disponibles','=', $value[12] )
                        ->get();
                    //si la fila en ejecucion esta repetida se omitirá su carga
                    if(empty($copia->toArray()) ){
                        // cargamos los registros ubicandole la clave foranea de el establecimiento que le corresponde
                        DB::table('registros')->insert(['fecha'=> $fecha, 'checkins'=> $value[6],'checkouts'=>$value[7],'pernoctaciones'=>$value[8],
                            'nacionales'=>$value[9],'extranjeros'=>$value[10],'habitaciones_ocupadas'=>$value[11],'habitaciones_disponibles'=>$value[12],
                            'tipo_tarifa'=>$value[13],'tarifa_promedio'=>$tarifaProm,'TAR_PER'=>$tarPer, 'ventas_netas'=>$ventasNetas, 
                            'porcentaje_ocupacion'=>$procentajeOcupacion,'revpar'=>$revpar,'empleados_temporales'=>$value[19],
                            'estado'=>$value[20], 'opciones'=>$value[21],'idEstablecimiento'=> $clave, 'idArchivo'=> $idArchivo[0]->id  ]);
                                
                    }
                }


                
                
            
            }

       }
    }
}
