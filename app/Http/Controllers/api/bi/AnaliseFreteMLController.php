<?php

namespace App\Http\Controllers\api\bi;

use App\Http\Controllers\Controller;
use App\Models\AnaliseFreteMl;
use Illuminate\Http\Request;

class AnaliseFreteMLController extends Controller
{
    /**
     * Insere dados para analise
     */

    public function insereDados(Request $request){
        // dd($request);

        $dados = AnaliseFreteMl::create([
            'data' => $request->dia,
            'pedidoid' => $request->pedidoid,
            'sku' => $request->sku,
            'anuncio' => $request->anuncio,
            'preco_venda' => $request->preco_venda,
            'frete_pago_cliente' => $request->frete_pago_cliente,
            'frete_subsidiado' => $request->frete_subsidiado,
            'comissao_porcentagem' => $request->comissao_porcentagem,
            'comissao_valor' => $request->comissao_valor,
            'custo_produto' => $request->custo_produto,
            'outras_despesas' => $request->outras_despesas,
            'receita_liquida' => $request->receita_liquida,
            'lucro' => $request->lucro,
            'margem_porcentagem' => $request->margem_porcentagem,
            'frete_vs_preco' => $request->frete_vs_preco,
            'alerta_margem' => $request->alerta_margem,
            'alerta_frete' => $request->alerta_frete,
            'uf_destino' => $request->uf_destino,
        ]);

        return response()->json([
            'dados' => $dados,
        ], 201);
    }


    public function buscaDado(Request $request)
    {
        return response()->json($request->AnaliseFreteMl());
    }


    /**
     * Listar todos os valores
     */
    public function listaDados()
    {
        $dados = AnaliseFreteMl::all();
        return response()->json($dados);
    }

}
