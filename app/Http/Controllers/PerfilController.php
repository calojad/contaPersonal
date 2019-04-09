<?php

namespace App\Http\Controllers;

use App\Models\CategoriaTransaccion;
use App\Models\Cuentas;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PerfilController extends Controller
{
    public function getIndex()
    {
        $id = Auth::user()->id;
        $formCuenta_desde = 'P';
        $user = User::find($id);

        $cuentas = Cuentas::where('usuario_id', $id)
            ->get();

        $categoriasIngreso = CategoriaTransaccion::where('tipo_transac_id', 1)
            ->whereRaw('(usuario_id = 1 OR usuario_id = ' . $id . ')')
            ->get();

        $categoriasGasto = CategoriaTransaccion::where('tipo_transac_id', 2)
            ->whereRaw('(usuario_id = 1 OR usuario_id = ' . $id . ')')
            ->get();

        return view('perfil.index', compact('user', 'cuentas', 'categoriasIngreso', 'categoriasGasto', 'formCuenta_desde'));
    }

    public function postSaveuserperfil(Request $request)
    {
        $data = $request->all();
        $id = Auth::user()->id;
        $user = User::find($id);
        request()->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'username' => 'required|string|max:60|unique:users,username,' . $id,
        ]);
        if ($request->get('password') != null) {
            request()->validate([
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'username' => 'required|string|max:60|unique:users,username,' . $id,
                'password' => 'required|string|min:6|confirmed',
            ]);
            $data['password'] = bcrypt($request->get('password'));
        } else {
            $data['password'] = $user->password;
        }
        if (empty($user)) {
            Session::flash('danger', 'Usuario no encontrado');
            return redirect('perfil/'.$id);
        }
        $user->update($data);
        Session::flash('success', 'Usuario Actualizado');

        return redirect('perfil/'.$id);
    }

    public function postImguser(Request $request){
        $file = $request->file('imagen');
        $user = User::find($request->get('userId'));
        if($file->isFile()){
            $nombre = $user->username.'-'.$file->getClientOriginalName();
            \Storage::disk('local')->put($nombre,  \File::get($file));
            $user->update(['imagen'=>'/storage/profile_img/'.$nombre]);
        }else{
            Session::flash('error', 'Error con el archivo.');
            return redirect('perfil');
        }

        Session::flash('success', 'Imagen de Perfil Actualizada');
        return redirect('perfil');
    }
}