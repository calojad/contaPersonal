<?php

namespace App\Http\Controllers;

use App\Models\Transacciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TransaccionController extends Controller
{
    public function crearIngreso(Request $request){
        $transac = Transacciones::create($request->all());
        Session::flash('success','Ingreso Agregado');
        return Redirect::to('/home/'.$transac->cuenta_id);
    }

    public function crearGasto(Request $request){
        $transac = Transacciones::create($request->all());
        Session::flash('success','Gasto Agregado');
        return Redirect::to('/home/'.$transac->cuenta_id);
    }

    public function getListatransacciones($cuentaId){
        $ingresos = Transacciones::leftjoin('categoria_transac','transaccion.categoria_transac_id','=','categoria_transac.id')
            ->where('transaccion.cuenta_id',$cuentaId)
            ->where('transaccion.tipo_transac_id',1)
            ->select('transaccion.id','transaccion.cuenta_id','transaccion.valor','transaccion.descripcion','transaccion.created_at','categoria_transac.nombre as categoria_nombre')
            ->get();
        $gastos = Transacciones::leftjoin('categoria_transac','transaccion.categoria_transac_id','=','categoria_transac.id')
            ->where('cuenta_id',$cuentaId)
            ->where('transaccion.tipo_transac_id',2)
            ->select('transaccion.id','transaccion.cuenta_id','transaccion.valor','transaccion.descripcion','transaccion.created_at','categoria_transac.nombre as categoria_nombre')
            ->get();
		$totalIng=0;
		$totalGas=0;
        foreach ($ingresos as $ing) {
        	$totalIng+=$ing->valor;
        }
        foreach ($gastos as $gast) {
        	$totalGas+=$gast->valor;
        }
        $total = $totalIng-$totalGas;
        return json_encode(['ingresos'=>$ingresos,'gastos'=>$gastos,'totalIng'=>$totalIng,'totalGas'=>$totalGas,'total'=>$total]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $transaccion = Transacciones::find($id);
        if (empty($transaccion)) {
            Session::flash('error','Transaccion no encontrada.');
            return Redirect::to('/home');
        }
        $transaccion->delete();
        Session::flash('success','Transaccion eliminada.');
        return Redirect::to('/home');
    }
}
