<?php

namespace App\Http\Controllers;

use App\Models\Cuentas;
use App\Models\Transacciones;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getIndex()
    {
        $id = Auth::user()->id;
        $cuentas = Cuentas::where('usuario_id', $id)
            ->get();
        $m = Carbon::now()->format('m');
        $gastosCateg = Transacciones::leftjoin('categoria_transac','categoria_transac.id', '=', 'transaccion.categoria_transac_id')
            ->leftjoin('cuentas','cuentas.id' ,'=', 'transaccion.cuenta_id')
            ->where('cuentas.usuario_id',Auth::user()->id)
            ->where('transaccion.tipo_transac_id',2)
            ->where('transaccion.tipo','S')
            ->whereMonth('transaccion.fecha', $m)
            ->select(DB::raw('transaccion.categoria_transac_id, categoria_transac.nombre,SUM(transaccion.valor) as gasto'))
            ->groupBy('transaccion.categoria_transac_id')
            ->get();
        /*$ingresos = Transacciones::leftjoin('cuentas','cuentas.id' ,'=', 'transaccion.cuenta_id')
            ->where('cuentas.usuario_id',Auth::user()->id)
            ->where('transaccion.tipo_transac_id',1)
            ->where('transaccion.tipo','I')
            ->whereMonth('transaccion.fecha', $m)
            ->select(DB::raw('SUM(transaccion.valor) as ingresos'))
            ->get();
        $gastos = Transacciones::leftjoin('cuentas','cuentas.id' ,'=', 'transaccion.cuenta_id')
            ->where('cuentas.usuario_id',Auth::user()->id)
            ->where('transaccion.tipo_transac_id',2)
            ->where('transaccion.tipo','S')
            ->whereMonth('transaccion.fecha', $m)
            ->select(DB::raw('SUM(transaccion.valor) as gastos'))
            ->get();*/

        return view('dashboard.index', compact('cuentas','gastosCateg'));
    }

    public function getdetalleCatGasto($catId){
        $m = Carbon::now()->format('m');
        $gastosCateg = Transacciones::leftjoin('categoria_transac','categoria_transac.id', '=', 'transaccion.categoria_transac_id')
            ->leftjoin('cuentas','cuentas.id' ,'=', 'transaccion.cuenta_id')
            ->where('cuentas.usuario_id',Auth::user()->id)
            ->where('transaccion.categoria_transac_id',$catId)
            ->where('transaccion.tipo','S')
            ->whereMonth('transaccion.fecha', $m)
            ->select(DB::raw('transaccion.categoria_transac_id, categoria_transac.nombre,transaccion.descripcion,valor'))
            ->get();

        return json_encode($gastosCateg);
    }

    public function getgastosMes($mes, $anio){
        $gastosCateg = Transacciones::leftjoin('categoria_transac','categoria_transac.id', '=', 'transaccion.categoria_transac_id')
            ->leftjoin('cuentas','cuentas.id' ,'=', 'transaccion.cuenta_id')
            ->where('cuentas.usuario_id',Auth::user()->id)
            ->where('transaccion.tipo_transac_id',2)
            ->where('transaccion.tipo','S')
            ->whereYear('transaccion.fecha', $anio)
            ->whereMonth('transaccion.fecha', $mes)
            ->select(DB::raw('transaccion.categoria_transac_id, categoria_transac.nombre,SUM(transaccion.valor) as gasto'))
            ->groupBy('transaccion.categoria_transac_id')
            ->get();

        return json_encode($gastosCateg);
    }

    public function getgastosAnio($anio){
        $gastosCateg = Transacciones::leftjoin('categoria_transac','categoria_transac.id', '=', 'transaccion.categoria_transac_id')
            ->leftjoin('cuentas','cuentas.id' ,'=', 'transaccion.cuenta_id')
            ->where('cuentas.usuario_id',Auth::user()->id)
            ->where('transaccion.tipo_transac_id',2)
            ->where('transaccion.tipo','S')
            ->whereYear('transaccion.fecha', $anio)
            ->select(DB::raw('transaccion.categoria_transac_id, categoria_transac.nombre,SUM(transaccion.valor) as gasto'))
            ->groupBy('transaccion.categoria_transac_id')
            ->get();

        return json_encode($gastosCateg);
    }
}