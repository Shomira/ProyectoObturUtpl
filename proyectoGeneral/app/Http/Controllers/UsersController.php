<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $usuarios = DB::table('users')
                    ->select('users.*')
                    ->orderBy('id','DESC')
                    ->get();
        if(Auth::user()->rol != 'Administrador'){return redirect('home');}
        return view('gestionUsuarios')->with('usuarios', $usuarios);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request -> all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'rol' => ['required', Rule::in(['Administrador', 'Establecimiento']) ],
            'password' => ['required', 'string', 'min:8', 'required_with:password_confirmation','same:password_confirmation'],
            'password_confirmation' => ['required']
        ],$messages = [
            'same' => 'Las contraseñas no coinciden.',
            'in' => 'El rol solo puede ser: Administrador o Establecimiento',
            'min' => 'El tamaño mínimo de la contraseña debe ser de 8 caracteres ',
        ]);
        
        if($validator -> fails()){
            
            return back()
                ->withInput()
                ->with('ErrorInsert', 'Favor de llenar correctamente todos los campos')
                ->withErrors($validator);
        } else {
            $usuario = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'rol' => $request->rol
            ]);
            Alert::success('Listo', 'Usuario Creado Correctamente');
            return back();
        }

    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Alert::success('Listo', 'El usuario se eliminó correctamente')->autoclose(2000);

        return back();
    }
    
    public function editarUsuario(Request $request)
    {
        $user = User::find($request->id);
        $validator = Validator::make($request -> all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'rol' => ['required', Rule::in(['Administrador', 'Establecimiento']) ]
        ],$messages = [
            'same' => 'Las contraseñas no coinciden.',
            'in' => 'El rol solo puede ser: Administrador o Establecimiento',
            'min' => 'El tamaño mínimo de la contraseña debe ser de 8 caracteres ',
        ]);

        if($validator -> fails()){
            return back()
                ->withInput()
                ->with('ErrorInsert', 'Favor de llenar correctamente todos los campos')
                ->withErrors($validator);
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->rol = $request->rol;
        
        
            $user->save();
            Alert::success('Listo', 'Usuario actualizado correctamente');
            return back();
        }

    }
}
