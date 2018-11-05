<?php

namespace App\Http\Controllers;

use App\Models\Cuentas;
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
    public function index()
    {
        $cuentas = Cuentas::where('usuario_id',Auth::user()->id)
            ->orderBy('id', 'asc')
            ->get();
        $tabActiva = $cuentas[0]->id;
        return view('home',compact('cuentas','tabActiva'));
    }
    public function inicio()
    {
        $cuentas = Cuentas::where('usuario_id',Auth::user()->id)
            ->orderBy('id', 'asc')
            ->get();
            $tabActiva = $cuentas[0]->id;
        Session::flash('info','Bienvenido a tus cuentas Personales.');
        return view('home',compact('cuentas','tabActiva'));
    }
}
