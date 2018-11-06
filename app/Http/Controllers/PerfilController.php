<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PerfilController extends Controller
{
    public function getIndex($id)
    {
        $user = User::find($id);
        return view('perfil.index',compact('user'));
    }

}