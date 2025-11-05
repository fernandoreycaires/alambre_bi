<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MLItemPedido extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "ml_itens_pedido";

    protected $fillable = [
        'id', 'pedido_id', 'item_id', 'titulo', 'categoria_id', 'variacao_id',
        'campo_personalizado_vendedor', 'preco_global', 'peso_liquido', 'garantia',
        'condicao', 'sku_vendedor', 'quantidade', 'preco_unitario', 'preco_unitario_completo',
        'moeda_id', 'dias_fabricacao', 'quantidade_selecionada', 'quantidade_solicitada_valor',
        'quantidade_solicitada_medida', 'taxa_venda', 'tipo_listagem_id', 'taxa_cambio_base',
        'moeda_base_id', 'elemento_id'
    ];

    public function pedido()
    {
        return $this->belongsTo(MLPedido::class, 'pedido_id');
    }
}
