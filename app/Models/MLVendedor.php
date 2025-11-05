<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MLVendedor extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "ml_vendedores";

    protected $fillable = ['id', 'apelido'];

    public function pedidos()
    {
        return $this->hasMany(MLPedido::class, 'vendedor_id');
    }

    public function pagamentos()
    {
        return $this->hasMany(MLPagamento::class, 'coletor_id');
    }
}
