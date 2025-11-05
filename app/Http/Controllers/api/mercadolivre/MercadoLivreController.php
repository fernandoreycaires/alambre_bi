<?php

namespace App\Http\Controllers\api\mercadolivre;

use App\Http\Controllers\Controller;
use App\Models\MLAcaoDisponivelPagamento;
use App\Models\MLComprador;
use App\Models\MLCupom;
use App\Models\MLEnvio;
use App\Models\MLImposto;
use App\Models\MLItemPedido;
use App\Models\MLPagamento;
use App\Models\MLPedido;
use App\Models\MLVendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MercadoLivreController extends Controller
{
    public function store(Request $request)
    {

        // dd($request->buyer);

        // Validação dos dados de entrada
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'date_created' => 'nullable|date',
            'date_closed' => 'nullable|date',
            'date_last_updated' => 'nullable|date',
            'last_updated' => 'nullable|date',
            'expiration_date' => 'nullable|date',
            'total_amount' => 'nullable|numeric',
            'paid_amount' => 'nullable|numeric',
            'currency_id' => 'nullable|max:10',
            'status' => 'nullable|string|max:50',
            'status_detail' => 'nullable|string|max:255',
            'pack_id' => 'nullable',
            'shipping_cost' => 'nullable|numeric',
            'comment' => 'nullable|string',
            'fulfilled' => 'nullable|boolean',
            'buyer.id' => 'required',
            'buyer.nickname' => 'required|string|max:255',
            'seller.id' => 'required',
            'seller.nickname' => 'required|string|max:255',
            'shipping.id' => 'nullable',
            'coupon.id' => 'nullable',
            'coupon.amount' => 'nullable|numeric',
            'taxes.id' => 'nullable',
            'taxes.amount' => 'nullable|numeric',
            'taxes.currency_id' => 'nullable|max:10',
            'order_items' => 'required|array',
            'order_items.*.item.id' => 'nullable|max:50',
            'order_items.*.item.title' => 'nullable|string|max:255',
            'order_items.*.quantity' => 'required|integer',
            'order_items.*.unit_price' => 'required|numeric',
            'payments' => 'required|array',
            'payments.*.id' => 'required',
            'payments.*.reason' => 'nullable|string|max:255',
            'payments.*.total_paid_amount' => 'nullable|numeric',
            'payments.*.status' => 'nullable|string|max:50',
            'payments.*.available_actions' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors(),
            ], 422);
        }

        try {
            return DB::transaction(function () use ($request) {
                // Verifica se o pedido já foi inserido no banco
                $consultaPedido = MLPedido::where('id_ml', $request->id)->first();
                    if (!$consultaPedido) {
                            
                        // Criar ou atualizar comprador
                        $comprador = new MLComprador();
                        $comprador->id = (string) Str::uuid();
                        $comprador->id_ml = $request->buyer['id'];
                        $comprador->apelido = $request->buyer['nickname'];
                        $comprador->save(); 

                        // Criar ou atualizar vendedor
                        $vendedor = new MLVendedor();
                        $vendedor->id = (string) Str::uuid();
                        $vendedor->id_ml = $request->seller['id'];
                        $vendedor->apelido = $request->seller['nickname'];
                        $vendedor->save();               


                        // Criar envio
                        $envio = null;
                        if ($request->shipping['id']) {
                            $envio = new MLEnvio();
                            $envio->id = (string) Str::uuid();
                            $envio->id_ml = $request->shipping['id'];
                            $envio->save(); 
                        }

                        // Criar cupom
                        $cupom = null;
                        if ($request->coupon['id']) {
                            $cupom = new MLCupom();
                            $cupom->id = (string) Str::uuid();
                            $cupom->id_ml = $request->coupon['id'];
                            $cupom->valor = $request->coupon['amount'];
                            $cupom->save(); 
                        }

                        // Criar imposto
                        $imposto = null;
                        if ($request->taxes['id']) {
                            $imposto = MLImposto::updateOrCreate(
                                ['id' => (string) Str::uuid()],
                                ['id_ml' => $request->input('taxes.id')],
                                [
                                    'valor' => $request->input('taxes.amount'),
                                    'moeda_id' => $request->input('taxes.currency_id'),
                                ]
                            );
                        }

                        // Criar pedido
                        $pedido = new MLPedido();
                            $pedido->id = (string) Str::uuid();
                            $pedido->id_ml = $request->id;
                            $pedido->data_criacao = $request->date_created;
                            $pedido->data_fechamento = $request->inputdate_closed;
                            $pedido->data_ultima_atualizacao = $request->date_last_updated;
                            $pedido->ultima_atualizacao = $request->last_updated;
                            $pedido->data_expiracao = $request->expiration_date;
                            $pedido->valor_total = $request->total_amount;
                            $pedido->valor_pago = $request->paid_amount;
                            $pedido->moeda_id = $request->currency_id;
                            $pedido->status = $request->status;
                            $pedido->detalhe_status = $request->status_detail;
                            $pedido->id_pacote = $request->pack_id;
                            $pedido->custo_envio = $request->shipping_cost;
                            $pedido->comentario = $request->comment;
                            $pedido->cumprido = $request->fulfilled;
                            $pedido->comprador_id = $comprador->id;
                            $pedido->vendedor_id = $vendedor->id;
                            $pedido->envio_id = $envio ? $envio->id : null;
                            $pedido->cupom_id = $cupom ? $cupom->id : null;
                            $pedido->imposto_id = $imposto ? $imposto->id : null;
                            $pedido->save();

                        
                        // Criar itens do pedido
                        foreach ($request->input('order_items', []) as $item) {
                            $orderItem = new MLItemPedido();
                            $orderItem->id = (string) Str::uuid();
                            $orderItem->pedido_id = $pedido->id;
                            $orderItem->item_id = $item['item']['id'] ?? null;
                            $orderItem->titulo = $item['item']['title'] ?? null;
                            $orderItem->categoria_id = $item['item']['category_id'] ?? null;
                            $orderItem->variacao_id = $item['item']['variation_id'] ?? null;
                            $orderItem->campo_personalizado_vendedor = $item['item']['seller_custom_field'] ?? null;
                            $orderItem->preco_global = $item['item']['global_price'] ?? null;
                            $orderItem->peso_liquido = $item['item']['net_weight'] ?? null;
                            $orderItem->garantia = $item['item']['warranty'] ?? null;
                            $orderItem->condicao = $item['item']['condition'] ?? null;
                            $orderItem->sku_vendedor = $item['item']['seller_sku'] ?? null;
                            $orderItem->quantidade = $item['quantity'];
                            $orderItem->preco_unitario = $item['unit_price'];
                            $orderItem->preco_unitario_completo = $item['full_unit_price'] ?? null;
                            $orderItem->moeda_id = $item['currency_id'] ?? null;
                            $orderItem->dias_fabricacao = $item['manufacturing_days'] ?? null;
                            $orderItem->quantidade_selecionada = $item['picked_quantity'] ?? null;
                            $orderItem->quantidade_solicitada_valor = $item['requested_quantity']['value'] ?? null;
                            $orderItem->quantidade_solicitada_medida = $item['requested_quantity']['measure'] ?? null;
                            $orderItem->taxa_venda = $item['sale_fee'] ?? null;
                            $orderItem->tipo_listagem_id = $item['listing_type_id'] ?? null;
                            $orderItem->taxa_cambio_base = $item['base_exchange_rate'] ?? null;
                            $orderItem->moeda_base_id = $item['base_currency_id'] ?? null;
                            $orderItem->elemento_id = $item['element_id'] ?? null;
                            $orderItem->save();
                        }

                        // Criar pagamentos
                        foreach ($request->input('payments', []) as $payment) {
                            $pagamento = new MLPagamento();
                                $pagamento->id = (string) Str::uuid();
                                $pagamento->id_ml = $payment['id'];
                                $pagamento->pedido_id = $pedido->id;
                                $pagamento->motivo = $payment['reason'] ?? null;
                                $pagamento->codigo_status = $payment['status_code'] ?? null;
                                $pagamento->valor_total_pago = $payment['total_paid_amount'] ?? null;
                                $pagamento->tipo_operacao = $payment['operation_type'] ?? null;
                                $pagamento->valor_transacao = $payment['transaction_amount'] ?? null;
                                $pagamento->valor_transacao_reembolsado = $payment['transaction_amount_refunded'] ?? null;
                                $pagamento->data_aprovacao = $payment['date_approved'] ?? null;
                                $pagamento->coletor_id = $payment['collector']['id'] ?? null;
                                $pagamento->cupom_id = $payment['coupon_id'] ?? null;
                                $pagamento->parcelas = $payment['installments'] ?? null;
                                $pagamento->codigo_autorizacao = $payment['authorization_code'] ?? null;
                                $pagamento->valor_impostos = $payment['taxes_amount'] ?? null;
                                $pagamento->data_ultima_modificacao = $payment['date_last_modified'] ?? null;
                                $pagamento->valor_cupom = $payment['coupon_amount'] ?? null;
                                $pagamento->custo_envio = $payment['shipping_cost'] ?? null;
                                $pagamento->valor_parcela = $payment['installment_amount'] ?? null;
                                $pagamento->data_criacao = $payment['date_created'] ?? null;
                                $pagamento->uri_ativacao = $payment['activation_uri'] ?? null;
                                $pagamento->valor_pago_excedente = $payment['overpaid_amount'] ?? null;
                                $pagamento->cartao_id = $payment['card_id'] ?? null;
                                $pagamento->detalhe_status = $payment['status_detail'] ?? null;
                                $pagamento->emissor_id = $payment['issuer_id'] ?? null;
                                $pagamento->metodo_pagamento_id = $payment['payment_method_id'] ?? null;
                                $pagamento->tipo_pagamento = $payment['payment_type'] ?? null;
                                $pagamento->periodo_diferido = $payment['deferred_period'] ?? null;
                                $pagamento->id_transacao_atm = $payment['atm_transfer_reference']['transaction_id'] ?? null;
                                $pagamento->id_empresa_atm = $payment['atm_transfer_reference']['company_id'] ?? null;
                                $pagamento->site_id = $payment['site_id'] ?? null;
                                $pagamento->pagador_id = $payment['payer_id'] ?? null;
                                $pagamento->moeda_id = $payment['currency_id'] ?? null;
                                $pagamento->status = $payment['status'] ?? null;
                                $pagamento->id_ordem_transacao = $payment['transaction_order_id'] ?? null;
                                $pagamento->save();

                            // Criar ações disponíveis para o pagamento
                            foreach ($payment['available_actions'] ?? [] as $action) {
                                $acaoDisp = new MLAcaoDisponivelPagamento();
                                    $acaoDisp->id = (string) Str::uuid();
                                    $acaoDisp->pagamento_id = $pagamento->id;
                                    $acaoDisp->acao = $action;
                                    $acaoDisp->save;
                            }
                        }    

                        return response()->json([
                            'message' => 'Order created successfully',
                            'order_id' => $pedido->id,
                        ], 201);
                    }

                    return response()->json([
                        'message' => 'Order already in base',
                        'order_id_ml' => $request->id,
                    ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create order',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
