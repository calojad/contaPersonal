<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaccionController extends Controller
{
    public function crearIngreso(Request $request){
        dd($request->all());
    }
    public function crearGasto(Request $request){
        dd($request->all());
    }
}
