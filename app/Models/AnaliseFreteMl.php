<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnaliseFreteMl extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "analise_frete_ml";
    protected $keyType = 'string';

    protected $fillable = [
        'data', // Adicione 'dia' aqui
        'pedidoid',
        'sku',        
        'anuncio',
        'preco_venda',
        'frete_pago_cliente',
        'frete_subsidiado',
        'comissao_porcentagem',
        'comissao_valor',
        'custo_produto',
        'outras_despesas',
        'receita_liquida',
        'lucro',
        'margem_porcentagem',
        'frete_vs_preco',
        'alerta_margem',
        'alerta_frete',
        'uf_destino'
        // Outros campos preenchíveis, se houver
    ];
}
