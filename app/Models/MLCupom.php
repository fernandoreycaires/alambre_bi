<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MLCupom extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "ml_cupons";

    protected $fillable = ['id', 'valor'];

    public function pedidos()
    {
        return $this->hasMany(MLPedido::class, 'cupom_id');
    }

    public function pagamentos()
    {
        return $this->hasMany(MLPagamento::class, 'cupom_id');
    }
}
