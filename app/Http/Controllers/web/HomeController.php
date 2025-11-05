<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $permissoes = Perfil::where('id_user', Auth::user()->id)->with('perfil_catalogo')->get();


        return view('web/home/home',[
            'permissoes' => $permissoes,
        ]);
    }
}
