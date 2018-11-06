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
        $ingresos = Transacciones::where('cuenta_id',$cuentaId)
        			->where('tipo',1)
        			->get();
        $gastos = Transacciones::where('cuenta_id',$cuentaId)
        			->where('tipo',0)
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
}
