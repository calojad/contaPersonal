<?php

namespace App\Http\Controllers;

use App\Models\Cuentas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CuentaController extends Controller
{
    public function crear()
    {
        $data['nombre'] = Input::get('nombre');
        $data['usuario_id'] = Auth::user()->id;
        Cuentas::create($data);

        return redirect('/home');
    }
}
