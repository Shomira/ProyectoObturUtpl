<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class VisualizarRegistrosController extends Controller
{
    public function index()
    {
        $idU = Auth::user()->id;

        $ultimaCaga = DB::select("SELECT DAY(Max(fecha)) as 'dia', MONTH(Max(fecha)) as 'mes', YEAR(Max(fecha)) as 'anio' 
                                FROM registros r, establecimientos e
                                WHERE e.id = r.idEstablecimiento AND e.idUsuario = $idU");

        $auxDia = $ultimaCaga[0]->dia;
        $auxMes = $ultimaCaga[0]->mes;
        $auxAnio = $ultimaCaga[0]->anio;


        $cadena = "SELECT * 
                    FROM registros r, establecimientos e 
                    WHERE MONTH(fecha) = $auxMes AND e.id = r.idEstablecimiento AND e.idUsuario = $idU";

        $registros = DB::select($cadena);
        
        $mensaje = "Establecimiento: Todos.  Desde: ".$auxAnio."-".$auxMes."-01 Hasta: ".$auxAnio."-".$auxMes."-".$auxDia;
        
        if(Auth::user()->rol != 'Establecimiento'){return redirect('home');}

        return view('visualizarRegistros')->with('registros', $registros)
                                        ->with('mensaje', $mensaje);
    }

    public function mostrar(Request $request){
        
        $nombreU = Auth::user()->name;

        $idestablecimientos = DB::table('establecimientos')
                        ->select('establecimientos.id')
                        ->where('nombre','=', $nombreU)
                        ->get();
        

        $registros = DB::table('registros')
                        ->select('registros.*')
                        ->where('idEstablecimiento','=', $idestablecimientos[0]->id)
                        ->where('fecha','>=', $request->inicio)
                        ->where('fecha','<=', $request->fin)
                        ->get();
        
        $mensaje = "Desde: ".$request->inicio." Hasta: ".$request->fin;
        

        return view('visualizarRegistros')->with('registros', $registros)
                                            ->with('mensaje', $mensaje);

    }
}
