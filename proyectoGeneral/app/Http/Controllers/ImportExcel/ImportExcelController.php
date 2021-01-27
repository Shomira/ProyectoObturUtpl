<?php

namespace App\Http\Controllers\ImportExcel;

use Illuminate\Http\Request;
//use Illuminate\Foundation\Http\FormRequest;
//use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Imports\HotelImport;
use App\Imports\ImportExcel;
use App\Imports\ImportExcelValidar;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Archivo;
use Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;



class ImportExcelController extends Controller
{
    public function index()
    {
        $files = Archivo::latest()->get();
        if(Auth::user()->rol != 'Administrador'){return redirect('home');}
        return view('archivos', compact('files'));
    }
    public function import(Request $request)
    {
        $now = new \DateTime();
        //$now->format('d-m-Y H:i:s')
        
        $request->validate([
            'import_file' => 'required',
            'import_file.*' => 'required|mimes:csv,xlsx,xls'
        ],$messages = [
            'mimes' => 'ERROR: El archivo no es de formato csv, xlsl o xls',
            'required' => 'Por favor elija un archivo'
        ]);
        

        $files = request()->file('import_file') ;
        $idUsuario = Auth::id();
        
        if($request->opcion == 1){

            foreach ($files as $file) {
                
                if(Storage::putFileAs('/public', $file, $now->format('d-m-Y').'-'.$file->getClientOriginalName())){
                    
                    Archivo::create([
                        'nombre'=> $now->format('d-m-Y').'-'.$file->getClientOriginalName()
                    ]);
                    
                    Excel::import(new ImportExcel, $file);

                }

            }
            Alert::success('Éxito', 'Datos importados Exitosamente.');

        }else{

            foreach ($files as $file) {

                
                Excel::import(new ImportExcelValidar, $file);

                //Obtenemos el id del Archivo cargado
                $idArchivo = DB::select("SELECT Max(id) as 'id' FROM archivos ");

                $file = Archivo::whereId($idArchivo[0]->id)->firstOrFail();
    
                $file->delete();

            }
            Alert::success('listo', 'Archivo(s) listo(s) para cargar');
        }



        return back();

    }

    public function destroy(Request $request, $id)
    {
        $file = Archivo::whereId($id)->firstOrFail();

        unlink(public_path('storage/'.$file->nombre));

        $file->delete();
        Alert::success('eliminado', 'Archivo Eliminado Exitosamente');
        return back(); 
    }

}
