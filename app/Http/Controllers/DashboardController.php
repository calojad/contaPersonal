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
            ->orderBy('saldo', 'desc')
            ->get();

        $m = Carbon::now()->format('m');
        $a = Carbon::now()->format('Y');
        $gastosCateg = Transacciones::leftjoin('categoria_transac','categoria_transac.id', '=', 'transaccion.categoria_transac_id')
            ->leftjoin('cuentas','cuentas.id' ,'=', 'transaccion.cuenta_id')
            ->where('cuentas.usuario_id',Auth::user()->id)
            ->where('transaccion.tipo_transac_id',2)
            ->where('transaccion.tipo','S')
            ->whereYear('transaccion.fecha', $a)
            ->whereMonth('transaccion.fecha', $m)
            ->select(DB::raw('transaccion.categoria_transac_id, categoria_transac.nombre,SUM(transaccion.valor) as gasto'))
            ->groupBy('transaccion.categoria_transac_id')
            ->orderBy('gasto', 'desc')
            ->get();
//        dd($gastosCateg);

        $anosTransacciones = DB::select('select year(fecha) años from transaccion group by  year(fecha)');
//        dd($anosTransacciones);
        return view('dashboard.index', compact('cuentas','gastosCateg', 'anosTransacciones', 'a'));
    }

    public function getdetalleCatGasto($catId,$m,$a){
//        $m = Carbon::now()->format('m');
        $gastosCateg = Transacciones::leftjoin('categoria_transac','categoria_transac.id', '=', 'transaccion.categoria_transac_id')
            ->leftjoin('cuentas','cuentas.id' ,'=', 'transaccion.cuenta_id')
            ->where('cuentas.usuario_id',Auth::user()->id)
            ->where('transaccion.categoria_transac_id',$catId)
            ->where('transaccion.tipo','S')
            ->whereYear('transaccion.fecha', $a)
            ->whereMonth('transaccion.fecha', $m)
            ->select(DB::raw('transaccion.categoria_transac_id, categoria_transac.nombre,transaccion.descripcion,valor, transaccion.fecha'))
            ->orderBy('valor', 'desc')
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
            ->orderBy('gasto', 'desc')
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
            ->orderBy('gasto', 'desc')
            ->get();

        return json_encode($gastosCateg);
    }
}