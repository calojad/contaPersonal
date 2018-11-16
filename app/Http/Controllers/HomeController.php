<?php

namespace App\Http\Controllers;

use App\Models\CategoriaTransaccion;
use App\Models\Cuentas;
use App\Models\TipoTransaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $tiposTransac = TipoTransaccion::all();
        $categoriasIngreso = CategoriaTransaccion::where('tipo_transac_id',1)
            ->orderBy('nombre')
            ->pluck('nombre','id');
        $categoriasGasto = CategoriaTransaccion::where('tipo_transac_id',2)
            ->orderBy('nombre')
            ->pluck('nombre','id');
        if(count($cuentas) != 0 && $tab == 0)
            $tabActiva = $cuentas[0]->id;
        return view('home', compact('cuentas','tabActiva','tiposTransac','categoriasGasto','categoriasIngreso','formCuenta_desde'));
    }

    public function inicio($tab=0)
    {
        $formCuenta_desde = 'H';
        $tabActiva = $tab;
        $cuentas = Cuentas::where('usuario_id', Auth::user()->id)
            ->orderBy('id', 'asc')
            ->get();
        $tiposTransac = TipoTransaccion::all();

        $categoriasIngreso = CategoriaTransaccion::where('tipo_transac_id',1)
            ->orderBy('nombre')
            ->pluck('nombre','id');
        $categoriasGasto = CategoriaTransaccion::where('tipo_transac_id',2)
            ->orderBy('nombre')
            ->pluck('nombre','id');

        if(count($cuentas) != 0 && $tab == 0)
            $tabActiva = $cuentas[0]->id;
        Session::flash('info', 'Bienvenido a tus cuentas Personales.');
        return view('home', compact('cuentas', 'tabActiva','tiposTransac','categoriasGasto','categoriasIngreso','formCuenta_desde'));
    }
}
