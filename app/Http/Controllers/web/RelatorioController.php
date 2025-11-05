<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RelatorioController extends Controller
{
    public function home()
    {
        $permissoes = Perfil::where('id_user', Auth::user()->id)->with('perfil_catalogo')->get();

        return view('web/relatorios/home/home', [
            'permissoes' => $permissoes,
        ]);
    }
}
