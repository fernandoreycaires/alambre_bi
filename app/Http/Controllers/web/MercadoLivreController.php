<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\MLPedido;
use App\Models\MlShipment;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MercadoLivreController extends Controller
{
    public function dashboard()
    {
        $permissoes = Perfil::where('id_user', Auth::user()->id)->with('perfil_catalogo')->get();

        $pedidos = MLPedido::with('comprador', 'envio', 'itens')->orderByDesc('data_criacao')->take(50)->get();
        $shipments = MlShipment::with('receiverAddress', 'substatusHistories')->orderByDesc('date_created')->take(500)->get();
        // dd($pedidos);

        return view('web/relatorios/ml/ml', [
            'permissoes' => $permissoes,
            'pedidos' => $pedidos,
            'shipments' => $shipments,
        ]);
    }
}
