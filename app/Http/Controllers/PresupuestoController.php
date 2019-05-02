<?php

namespace App\Http\Controllers;

use App\Models\CategoriaTransaccion;
use App\Models\Presupuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $categoriaTransac = CategoriaTransaccion::whereIn('usuario_id',[1,Auth::user()->id])
            ->where('tipo_transac_id',2)
            ->orderBy('nombre','asc')
            ->pluck('nombre','id');

        $presupuestos = Presupuesto::where('usuario_id',Auth::user()->id)->get();

        return view('presupuesto.index',compact('categoriaTransac','presupuestos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $request->validate([
            'valor' => 'required|numeric',
            'categoria_transac_id' => 'required|numeric'
        ]);

        $presupuesto = $request->all();

        Presupuesto::create($presupuesto);
        Session::flash('success', 'Categoria Presupuestaria agregada con exito.');

        return redirect('/presupuesto');
    }

    public function getTotales($ing)
    {
        $gasto = Presupuesto::where('usuario_id',Auth::user()->id)
            ->sum('valor');

        return $ing - $gasto;
    }
}
