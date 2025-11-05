<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MLPedido extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "ml_pedidos";

    protected $fillable = [
        'id', 'data_criacao', 'data_fechamento', 'data_ultima_atualizacao', 'ultima_atualizacao',
        'data_expiracao', 'valor_total', 'valor_pago', 'moeda_id', 'status', 'detalhe_status',
        'id_pacote', 'custo_envio', 'comentario', 'cumprido', 'comprador_id', 'vendedor_id',
        'envio_id', 'cupom_id', 'imposto_id'
    ];

    public function comprador()
    {
        return $this->belongsTo(MLComprador::class, 'comprador_id');
    }

    public function vendedor()
    {
        return $this->belongsTo(MLVendedor::class, 'vendedor_id');
    }

    public function envio()
    {
        return $this->belongsTo(MLEnvio::class, 'envio_id');
    }

    public function cupom()
    {
        return $this->belongsTo(MLCupom::class, 'cupom_id');
    }

    public function imposto()
    {
        return $this->belongsTo(MLImposto::class, 'imposto_id');
    }

    public function itens()
    {
        return $this->hasMany(MLItemPedido::class, 'pedido_id');
    }

    public function pagamentos()
    {
        return $this->hasMany(MLPagamento::class, 'pedido_id');
    }

   
}
