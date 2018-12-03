<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaTransaccion;
use App\Models\Cuentas;
use App\User;
use DB;

class PerfilController extends Controller
{
    public function getIndex($id)
    {
    	$formCuenta_desde = 'P';
        $user = User::find($id);

        $cuentas = Cuentas::leftjoin('transaccion','cuentas.id','=','transaccion.cuenta_id')
        	->select(DB::raw('((Select SUM(transaccion.valor)
        	                   From transaccion
        	                   Where transaccion.tipo_transac_id = 1) - 
        	                   (Select SUM(transaccion.valor)
        	                   From transaccion
        	                   Where transaccion.tipo_transac_id = 2)) as saldo, 
        	                   cuentas.nombre, cuentas.id'))
        	->where('cuentas.usuario_id',$id)
        	->groupBy('cuentas.id')
        	->get();

        $categoriasIngreso = CategoriaTransaccion::where('tipo_transac_id',1)
        	->whereRaw('(usuario_id = 1 OR usuario_id = '.$id.')')
        	->get();

        $categoriasGasto = CategoriaTransaccion::where('tipo_transac_id',2)
	    	->whereRaw('(usuario_id = 1 OR usuario_id = '.$id.')')
        	->get();

        return view('perfil.index',compact('user','cuentas','categoriasIngreso','categoriasGasto','formCuenta_desde'));
    }
}