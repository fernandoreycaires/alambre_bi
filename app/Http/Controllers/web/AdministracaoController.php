<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministracaoController extends Controller
{
    public function home()
    {
        $usuarios = User::all()->sortBy('name') ;
        $permissoes = Perfil::where('id_user', Auth::user()->id)->with('perfil_catalogo')->get();

        return view('web/administracao/home/home', [
            'usuarios' => $usuarios,
            'permissoes' => $permissoes,
        ]);
    }
}
