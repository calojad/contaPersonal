<?php

namespace App\Http\Controllers;

use App\Models\Cuentas;
use App\Models\Transacciones;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class CuentaController extends Controller
{
    protected function calcularSaldo($id)
    {
        $cuentas = Cuentas::select(DB::raw('
        	((Select IfNull(SUM(transaccion.valor),0)
        	  From transaccion
        	  Where transaccion.tipo_transac_id = 1
        	  and transaccion.cuenta_id = '.$id.') - 
        	  (Select IfNull(SUM(transaccion.valor),0)
        	  From transaccion
        	  Where transaccion.tipo_transac_id = 2
        	  and transaccion.cuenta_id = '.$id.')) as saldo'))
            ->where('id',$id)
            ->first();

        return $cuentas->saldo;
    }

    public function crear()
    {
        $data['nombre'] = Input::get('nombre');
        $data['usuario_id'] = Auth::user()->id;
        Cuentas::create($data);

        if(Input::get('formCuenta_desde') === 'H')
        	return redirect('/home');
        else
        	return redirect('/perfil');
    }

    public function getUpdate(Request $request, $id)
    {
        $cuenta = Cuentas::find($id);
        if (empty($cuenta)) {
            Session::flash('error','Cuenta no encontrada.');
            return json_encode(['url' => '/perfil']);
        }
        $cuenta->update($request->all());
        Session::flash('success','Cuenta Actualizada.');
        return json_encode(['url' => '/perfil']);
    }

    public function getDestroy($id)
    {
    	$cuenta = Cuentas::find($id);
        if (empty($cuenta)) {
            Session::flash('error','Cuenta no encontrada.');
            return json_encode(['url' => '/perfil']);
        }
        try{
            $cuenta->delete();
        }catch(\Illuminate\Database\QueryException $e){
            return json_encode(['url' => 'Error al eliminar la cuenta<br>'.$e->getMessage(),'error'=>true]);
        }

        Session::flash('success','Cuenta eliminada');
        return json_encode(['url' => '/perfil','error'=>false]);
        
    }

    public function getListransferir($cuentaId){
        $cuentas = Cuentas::where('usuario_id', Auth::user()->id)
            ->where('id','<>',$cuentaId)
            ->orderBy('id', 'asc')
            ->pluck('nombre','id');

        return json_encode($cuentas);
    }

    public function postTransferir(Request $request){
        $saldo = $this->calcularSaldo($request->get('cuenta_ini_id'));
        if($request->get('valor') > $saldo){
            Session::flash('error', 'El valor a transferir supera al saldo de la cuenta');
            return redirect('/home');
        }else {

            $data_gast['cuenta_id'] = $request->get('cuenta_ini_id');
            $data_gast['tipo_transac_id'] = 2;
            $data_gast['categoria_transac_id'] = $request->get('categorias');
            $data_gast['descripcion'] = $request->get('descripcion');
            $data_gast['valor'] = $request->get('valor');
            $data_gast['fecha'] = Carbon::now()->format('Y-m-d');
            $data_gast['tipo'] = 'T';

            Transacciones::create($data_gast);

            $data_ing['cuenta_id'] = $request->get('cuenta_des');
            $data_ing['tipo_transac_id'] = 1;
            $data_ing['categoria_transac_id'] = $request->get('categorias');
            $data_ing['descripcion'] = $request->get('descripcion');
            $data_ing['valor'] = $request->get('valor');
            $data_ing['fecha'] = Carbon::now()->format('Y-m-d');
            $data_ing['tipo'] = 'T';

            Transacciones::create($data_ing);

            Session::flash('success', 'Transferencia exitosa.');
            return redirect('/home');
        }
    }
}