<?php

namespace App\Http\Controllers;

use App\Models\CategoriaTransaccion;
use App\Models\Cuentas;
use App\Models\TipoTransaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tab=0)
    {
        $formCuenta_desde = 'H';
        $tabActiva = $tab;
        $cuentas = Cuentas::where('usuario_id', Auth::user()->id)
            ->orderBy('id', 'asc')
            ->get();
        $categoriasIngreso = CategoriaTransaccion::where('tipo_transac_id',1)
            ->whereIn('usuario_id',[1,Auth::user()->id])
            ->orderBy('nombre')
            ->pluck('nombre','id');
        $categoriasGasto = CategoriaTransaccion::where('tipo_transac_id',2)
            ->whereIn('usuario_id',[1,Auth::user()->id])
            ->orderBy('nombre')
            ->pluck('nombre','id');
        $categorias = CategoriaTransaccion::whereIn('usuario_id',[1,Auth::user()->id])
            ->orderBy('nombre')
            ->pluck('nombre','id');
        if(count($cuentas) != 0 && $tab == 0)
            $tabActiva = $cuentas[0]->id;
        return view('home', compact('cuentas','tabActiva','categoriasGasto','categoriasIngreso','formCuenta_desde','categorias'));
    }

    public function inicio($tab=0)
    {
        $formCuenta_desde = 'H';
        $tabActiva = $tab;
        $cuentas = Cuentas::where('usuario_id', Auth::user()->id)
            ->orderBy('id', 'asc')
            ->get();
        $categoriasIngreso = CategoriaTransaccion::where('tipo_transac_id',1)
            ->whereIn('usuario_id',[1,Auth::user()->id])
            ->orderBy('nombre')
            ->pluck('nombre','id');
        $categoriasGasto = CategoriaTransaccion::where('tipo_transac_id',2)
            ->whereIn('usuario_id',[1,Auth::user()->id])
            ->orderBy('nombre')
            ->pluck('nombre','id');
        $categorias = CategoriaTransaccion::whereIn('usuario_id',[1,Auth::user()->id])
            ->orderBy('nombre')
            ->pluck('nombre','id');
        if(count($cuentas) != 0 && $tab == 0)
            $tabActiva = $cuentas[0]->id;
        Session::flash('info', 'Bienvenido a tus cuentas Personales.');
        return view('home', compact('cuentas', 'tabActiva','categoriasGasto','categoriasIngreso','formCuenta_desde','categorias'));
    }
}
