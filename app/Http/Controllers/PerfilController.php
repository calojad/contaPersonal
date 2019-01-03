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
    public function getIndex($id)
    {
        $formCuenta_desde = 'P';
        $user = User::find($id);

        $cuentas = Cuentas::leftjoin('transaccion', 'cuentas.id', '=', 'transaccion.cuenta_id')
            ->select(DB::raw('
        	((Select SUM(transaccion.valor)
        	  From transaccion
        	  Where transaccion.tipo_transac_id = 1
        	  and transaccion.cuenta_id = cuentas.id) - 
        	  (Select SUM(transaccion.valor)
        	  From transaccion
        	  Where transaccion.tipo_transac_id = 2
        	  and transaccion.cuenta_id = cuentas.id)) as saldo,cuentas.nombre,cuentas.id'))
            ->where('cuentas.usuario_id', $id)
            ->groupBy('cuentas.id')
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
}