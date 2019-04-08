<?php

namespace App\Http\Controllers;

use App\Models\Cuentas;
use App\Models\Transacciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TransaccionController extends Controller
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

    public function crearIngreso(Request $request)
    {
        $transac = Transacciones::create($request->all());

        Cuentas::where('id',$request->get('cuenta_id'))
            ->update(['saldo' => $this->calcularSaldo($request->get('cuenta_id'))]);

        Session::flash('success', 'Ingreso Agregado');
        return Redirect::to('/home/' . $transac->cuenta_id);
    }

    public function crearGasto(Request $request)
    {
        $transac = Transacciones::create($request->all());

        Cuentas::where('id',$request->get('cuenta_id'))
            ->update(['saldo' => $this->calcularSaldo($request->get('cuenta_id'))]);

        Session::flash('success', 'Gasto Agregado');
        return Redirect::to('/home/' . $transac->cuenta_id);
    }

    public function getListatransacciones($cuentaId, $desde, $hasta)
    {
        $saldo = $this->calcularSaldo($cuentaId);
        Cuentas::where('id',$cuentaId)
            ->update(['saldo'=>$saldo]);

        $ingresos = Transacciones::leftjoin('categoria_transac', 'transaccion.categoria_transac_id', '=', 'categoria_transac.id')
            ->where('transaccion.cuenta_id', $cuentaId)
            ->where('transaccion.tipo_transac_id', 1)
            ->whereBetween('transaccion.fecha', [$desde, $hasta])
            ->select('transaccion.id', 'transaccion.cuenta_id', 'transaccion.valor', 'transaccion.descripcion', 'transaccion.fecha', 'categoria_transac.nombre as categoria_nombre')
            ->get();

        $gastos = Transacciones::leftjoin('categoria_transac', 'transaccion.categoria_transac_id', '=', 'categoria_transac.id')
            ->where('cuenta_id', $cuentaId)
            ->where('transaccion.tipo_transac_id', 2)
            ->whereBetween('transaccion.fecha', [$desde, $hasta])
            ->select('transaccion.id', 'transaccion.cuenta_id', 'transaccion.valor', 'transaccion.descripcion', 'transaccion.fecha', 'categoria_transac.nombre as categoria_nombre')
            ->get();
        $totalIng = 0;
        $totalGas = 0;
        foreach ($ingresos as $ing) {
            $totalIng += $ing->valor;
        }
        foreach ($gastos as $gast) {
            $totalGas += $gast->valor;
        }
        $total = $totalIng - $totalGas;
        return json_encode(['ingresos' => $ingresos, 'gastos' => $gastos, 'totalIng' => $totalIng, 'totalGas' => $totalGas, 'total' => $total]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function getDestroy($id)
    {
        $transaccion = Transacciones::find($id);
        if (empty($transaccion)) {
            Session::flash('error', 'Transaccion no encontrada.');
            return Redirect::to('/home');
        }
        $cuenta = $transaccion->cuenta_id;
        $transaccion->delete();
        Session::flash('success', 'Transaccion eliminada.');
        return Redirect::to('/home' . '/' . $cuenta);
    }
}
