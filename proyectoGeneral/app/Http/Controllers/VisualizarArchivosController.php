<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class VisualizarArchivosController extends Controller
{
    public function index()
    {
        $establecimientos = DB::table('establecimientos')
                    ->select('establecimientos.*')
                    ->orderBy('id','DESC')
                    ->get();


        $fechaMaxima = DB::select('SELECT Max(fecha) as fecha FROM registros');
        
        $ultimaCaga = DB::select('SELECT DAY(Max(fecha)) as "dia", MONTH(Max(fecha)) as "mes", YEAR(Max(fecha)) as "anio" FROM registros');
        $auxDia = $ultimaCaga[0]->dia;
        $auxMes = $ultimaCaga[0]->mes;
        $auxAnio = $ultimaCaga[0]->anio;

        if($auxMes == null){
            $cadena = "SELECT * FROM registros";
            $alerta = "No existen registros";
        }else{
            $cadena = "SELECT r.*, e.nombre FROM registros r, establecimientos e WHERE e.id = r.idEstablecimiento AND MONTH(fecha) = $auxMes";
            $alerta = null;
        }
        
        $registros = DB::select($cadena);
        
        if($auxMes < 10){
            $desde=$auxAnio."-0".$auxMes."-01";
        }else{
            $desde=$auxAnio."-".$auxMes."-01";
        }
        
        $nombreEs='Todos';
        
        if(Auth::user()->rol != 'Administrador'){return redirect('home');}
        return view('visualizarArchivos')->with('establecimientos', $establecimientos)
                                        ->with('registros', $registros)
                                        ->with('alerta', $alerta)
                                        ->with('desde',$desde)
                                        ->with('filtroEstabl',$nombreEs)
                                        ->with('hasta',$fechaMaxima[0]->fecha);

    }

    public function mostrar(Request $request){

        $establecimientos = DB::table('establecimientos')
        ->select('establecimientos.*')
        ->orderBy('id','DESC')
        ->get();

        if($request->nombre == "Todos"){

            $cadena = "SELECT r.*, e.nombre 
                        FROM registros r, establecimientos e 
                        WHERE e.id = r.idEstablecimiento AND fecha >= '$request->inicio' AND fecha <= '$request->fin' ";

        }else{

            $cadena = "SELECT r.*, e.nombre 
                        FROM registros r, establecimientos e 
                        WHERE e.id = r.idEstablecimiento AND fecha >= '$request->inicio' AND fecha <= '$request->fin' AND e.nombre = '$request->nombre'";

            
        }
        
        $registros = DB::select($cadena);
        
        return view('visualizarArchivos')->with('establecimientos', $establecimientos)
                                    ->with('registros', $registros)
                                    ->with('filtroEstabl',$request->nombre)
                                    ->with('desde',$request->inicio)
                                    ->with('hasta',$request->fin);

        
    }

    


}
