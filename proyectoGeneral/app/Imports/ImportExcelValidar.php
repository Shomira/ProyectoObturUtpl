<?php

namespace App\Imports;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Establecimiento;
use Illuminate\Support\Facades\Validator;
use App\Models\Registro;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Archivo;
use Illuminate\Support\Facades\Storage;

class ImportExcelValidar implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        
        $ultimaFinla = sizeof($collection->toArray() ) -1 ;
        $bandera = false;

        Archivo::create([
            'nombre'=> 'prueba'
        ]);
        
        //dd(sizeof($collection->toArray() ));
        foreach($collection as $key=>$value){

            if($key==1){
                $fechaux = explode('/', $value[5]);
                $nom = $value[0];
                $mes = $fechaux[2]."-".$fechaux[1];
                $texto = "Error en el archivo de $nom del $mes";
            }

            if($key>0)
            {
                //Obtenemos el id del Archivo cargado
                $idArchivo = DB::select("SELECT Max(id) as 'id' FROM archivos ");
                
                // Validamos si existe un usuario que enlazar con el archivo cargado
                $aux=$value[0];
                $pruebaUsuario = DB::select("SELECT id FROM users WHERE name= '$aux' ");
                
                if(empty($pruebaUsuario)){

                    $file = Archivo::whereId($idArchivo[0]->id)->firstOrFail();
                    
                    $file->delete();

                    Validator::make($value->toArray(), [
                        '0' => 'exists:App\Models\User,name'
                    ],$messages = [
                        'exists' => 'No existe  un usuario relacionado al archivo que desea cargar'
                    ])->validate();

                }
                

                // Validamos si la fecha cargada es correcta
                $fechaux = explode('/', $value[5]);

                if (count($fechaux) != 3) {
                    //escribimos en nuestra cadena el error pertinente a la fecha
                    $linea = $key+1;
                    $texto = $texto."/Error de fecha en linea $linea ";
                    $bandera = true;

                }else{
                    
                    $fecha = $fechaux[2]."-".$fechaux[1]."-".$fechaux[0];
                    //verificamos si existe una linea igual en la base de datos
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
                    
                    //validamos si existe alguna fila para escribir en nuestra cadena el error pertinente a las filas repetidas
                    if (empty($copia->toArray())) {
                        
                        DB::table('registros')->insert(['fecha'=> $fecha, 'checkins'=> $value[6],'checkouts'=>$value[7],'pernoctaciones'=>$value[8],
                            'nacionales'=>$value[9],'extranjeros'=>$value[10],'habitaciones_ocupadas'=>$value[11],'habitaciones_disponibles'=>$value[12],
                            'tipo_tarifa'=>$value[13],'tarifa_promedio'=>0,'TAR_PER'=>0, 'ventas_netas'=>0, 
                            'porcentaje_ocupacion'=>0,'revpar'=>0,'empleados_temporales'=>$value[19],
                            'estado'=>$value[20], 'opciones'=>$value[21],'idEstablecimiento'=> null, 'idArchivo'=> $idArchivo[0]->id ]);
                        
                    }else{
                        $bandera = true;
                        $linea = $key+1;
                        $texto = $texto."/Error, la linea $linea está repetida";
                    }

                }
                
            }


            if( $key == $ultimaFinla )
            {

                if( $bandera){
                    
                    $file = Archivo::whereId($idArchivo[0]->id)->firstOrFail();
                    
                    $file->delete();
                    
                    $value[0] = null;
                    Validator::make($value->toArray(), [
                        '0'  => 'required'
                    ],$messages = [
                        'required' => $texto
                    ])->validate();

                }
                

            }

            
        }
    }
}
