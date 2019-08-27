<?php

namespace App\Http\Controllers;

use App\Models\Cuentas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getIndex()
    {
        $id = Auth::user()->id;
        $cuentas = Cuentas::where('usuario_id', $id)
            ->get();

       return view('dashboard.index', compact('cuentas'));
    }
}