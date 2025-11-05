<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MLPagamento extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "ml_pagamentos";

    protected $fillable = [
        'id', 'pedido_id', 'motivo', 'codigo_status', 'valor_total_pago', 'tipo_operacao',
        'valor_transacao', 'valor_transacao_reembolsado', 'data_aprovacao', 'coletor_id',
        'cupom_id', 'parcelas', 'codigo_autorizacao', 'valor_impostos', 'data_ultima_modificacao',
        'valor_cupom', 'custo_envio', 'valor_parcela', 'data_criacao', 'uri_ativacao',
        'valor_pago_excedente', 'cartao_id', 'detalhe_status', 'emissor_id', 'metodo_pagamento_id',
        'tipo_pagamento', 'periodo_diferido', 'id_transacao_atm', 'id_empresa_atm', 'site_id',
        'pagador_id', 'moeda_id', 'status', 'id_ordem_transacao'
    ];

    public function pedido()
    {
        return $this->belongsTo(MLPedido::class, 'pedido_id');
    }

    public function coletor()
    {
        return $this->belongsTo(MLVendedor::class, 'coletor_id');
    }

    public function cupom()
    {
        return $this->belongsTo(MLCupom::class, 'cupom_id');
    }

    public function pagador()
    {
        return $this->belongsTo(MLComprador::class, 'pagador_id');
    }

    public function acoesDisponiveis()
    {
        return $this->hasMany(MLAcaoDisponivelPagamento::class, 'pagamento_id');
    }
}
