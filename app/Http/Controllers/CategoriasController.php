<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaTransaccion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        request()->validate([
            'nombre' => 'required|string|unique:categoria_transac,nombre,'
        ]);

        $data = $request->all();
        $data['usuario_id'] = Auth::user()->id;
        CategoriaTransaccion::create($data);
        Session::flash('success','Categoria Agregado');
        return redirect('/perfil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function getUpdate(Request $request, $id)
    {
        $categoria = CategoriaTransaccion::find($id);
        if (empty($categoria)) {
            Session::flash('error','Categoria no encontrada.');
            return json_encode(['url' => '/perfil/'.Auth::user()->id]);
        }
        $categoria->update($request->all());
        Session::flash('success','Categoria Actualizada.');
        return json_encode(['url' => '/perfil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDestroy($id)
    {
        $categ = CategoriaTransaccion::find($id);
        if (empty($categ)) {
            Session::flash('error','Categoria no encontrada.');
            return json_encode(['url' => '/perfil']);
        }
        $categ->delete();
        Session::flash('success','Categoria eliminada.');
        return json_encode(['url' => '/perfil']);
    }
}
