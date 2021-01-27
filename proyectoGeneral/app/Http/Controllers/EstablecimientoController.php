<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstablecimientoController extends Controller
{

    public function index()
    {
 
        $idU = Auth::user()->id;
        $datosActuales = DB::select("SELECT distinct MONTH(Max(fecha)) as 'mes', YEAR(Max(fecha)) as 'anio' 
                                    FROM registros r, establecimientos e
                                    WHERE e.id = r.idEstablecimiento AND e.idUsuario = $idU");

        $auxMes = $datosActuales[0]->mes;
        $auxAnio = $datosActuales[0]->anio;
        
        //obtener todos los meses disponibles
        

        $mesesAnios = DB::select("SELECT distinct MONTH(fecha) as 'mes', YEAR(fecha) as 'anio' 
                                FROM registros r, establecimientos e
                                WHERE e.id = r.idEstablecimiento AND e.idUsuario = $idU
                                ORDER BY MONTH(fecha)");
        
        foreach ($mesesAnios as $key => $value) {
            
            switch ($value->mes) {
                case 1:
                    $meses[$key] = array( 0 => "Enero", 1 => 1) ;
                    break;
                case 2:
                    $meses[$key] = array( 0 => "Febrero", 1 => 2) ;
                    break;
                case 3:
                    $meses[$key] = array( 0 => "Marzo", 1 => 3) ;
                    break;
                case 4:
                    $meses[$key] = array( 0 => "Abril", 1 => 4) ;
                    break;
                case 5:
                    $meses[$key] = array( 0 => "Mayo", 1 => 5) ;
                    break;
                case 6:
                    $meses[$key] = array( 0 => "Junio", 1 => 6) ;
                    break;
                case 7:
                    $meses[$key] = array( 0 => "Julio", 1 => 7) ;
                    break;
                case 8:
                    $meses[$key] = array( 0 => "Agosto", 1 => 8) ;
                    break;
                case 9:
                    $meses[$key] = array( 0 => "Septiembre", 1 => 9) ;
                    break;
                case 10:
                    $meses[$key] = array( 0 => "Octubre", 1 => 10) ;
                    break;
                case 11:
                    $meses[$key] = array( 0 => "Noviembre", 1 => 11) ;
                    break;
                case 12:
                    $meses[$key] = array( 0 => "Diciembre", 1 => 12) ;
                    break;
                }
        }

        $registros = DB::select("SELECT Min(fecha) as 'diaMin', Max(fecha) as 'diaMax'
                                FROM registros r, establecimientos e
                                WHERE e.id = r.idEstablecimiento AND e.idUsuario = $idU AND MONTH(fecha) = $auxMes");

        $diaMin = $registros[0]->diaMin;
        $diaMax = $registros[0]->diaMax;


        return view('visualizarGraficas')->with('mesInicio',$auxMes - 2)
                                        ->with('mesFin',$auxMes)
                                        ->with('meses',$meses)
                                        ->with('diaMin',$diaMin)
                                        ->with('diaMax',$diaMax)
                                        ->with('columna',"porcentaje_ocupacion");

    }
   
    public function all(Request $request)
    {
        $idU = Auth::user()->id;
        
        $consulta = "SELECT  SUM($request->columna) as 'columna', MONTH(fecha) as 'mes'
                    FROM registros r, establecimientos e
                    WHERE e.id = r.idEstablecimiento AND e.idUsuario = $idU AND MONTH(fecha) >= $request->mesInicio AND MONTH(fecha) <= $request->mesFin
                    GROUP BY MONTH(fecha)";

        $datos= DB::select($consulta);
        
        return response(json_encode($datos), 200)->header('Content-type', 'text/plain');
    }

    public function dias(Request $request)
    {
        $idU = Auth::user()->id;

        $consulta = "SELECT $request->columna as 'columna', fecha 
                            FROM registros r, establecimientos e
                            WHERE e.id = r.idEstablecimiento AND e.idUsuario = $idU AND fecha >= '$request->inicio' AND fecha <= '$request->fin' ";
        
        $datos= DB::select($consulta);
        
        return response(json_encode($datos), 200)->header('Content-type', 'text/plain');
    }

    
    
}
