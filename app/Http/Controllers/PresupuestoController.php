<?php

namespace App\Http\Controllers;

use App\Models\CategoriaTransaccion;
use App\Models\Presupuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PresupuestoController extends Controller
{
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

    public function postUpdate(Request $request)
    {
        $request->validate([
            'valor' => 'required|numeric',
            'categoria_transac_id' => 'required|numeric'
        ]);

        $presu = Presupuesto::updateOrCreate(
            ['id' => $request->get('id'), 'usuario_id' => $request->get('usuario_id')],
            ['categoria_transac_id' => $request->get('categoria_transac_id'), 'valor' => $request->get('valor'), 'descripcion' => $request->get('descripcion')]
        );
        Session::flash('success', 'Categoria Presupuestaria modificada con exito.');
        return redirect('/presupuesto');
    }

    public function getTotales($ing)
    {
        $gasto = Presupuesto::where('usuario_id',Auth::user()->id)
            ->sum('valor');

        return $ing - $gasto;
    }

    public function getPresupuestopagado()
    {
        $yaPagado = Presupuesto::where('usuario_id',Auth::user()->id)
        ->where('estado', 1)
        ->sum('valor');

        return $yaPagado;
    }

    public function getDestroy($id)
    {
        $presupuesto = Presupuesto::find($id);
        if (empty($presupuesto)) {
            Session::flash('error','Presupuesto no encontrada.');
            return json_encode(['url' => '/presupuesto']);
        }
        $presupuesto->delete();
        Session::flash('success','Presupuesto eliminado.');
        return json_encode(['url' => '/presupuesto']);
    }

    public function getActualizarEstado($id,$estado){
        $presupuesto = Presupuesto::find($id);
        $presupuesto->update(['estado'=>$estado]);
    }
}
