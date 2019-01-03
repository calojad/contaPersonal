<?php

namespace App\Http\Controllers;

use App\Models\Cuentas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class CuentaController extends Controller
{
    public function crear()
    {
        $data['nombre'] = Input::get('nombre');
        $data['usuario_id'] = Auth::user()->id;
        Cuentas::create($data);

        if(Input::get('formCuenta_desde') === 'H')
        	return redirect('/home');
        else
        	return redirect('/perfil/'.Auth::user()->id);
    }

    public function getUpdate(Request $request, $id)
    {
        $cuenta = Cuentas::find($id);
        if (empty($cuenta)) {
            Session::flash('error','Cuenta no encontrada.');
            return json_encode(['url' => '/perfil/'.Auth::user()->id]);
        }
        $cuenta->update($request->all());
        Session::flash('success','Cuenta Actualizada.');
        return json_encode(['url' => '/perfil/'.Auth::user()->id]);
    }

    public function getDestroy($id)
    {
    	$cuenta = Cuentas::find($id);
        if (empty($cuenta)) {
            Session::flash('error','Cuenta no encontrada.');
            return json_encode(['url' => '/perfil/'.Auth::user()->id]);
        }
        $cuenta->delete();
        Session::flash('success','Cuenta eliminada.');
        return json_encode(['url' => '/perfil/'.Auth::user()->id]);
    }
}