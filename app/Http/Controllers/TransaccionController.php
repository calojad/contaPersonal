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
        $transacciones = Transacciones::where('cuenta_id',$cuentaId)->get();
        return json_encode($transacciones);
    }
}
