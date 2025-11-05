<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MLComprador extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "ml_compradores";

    protected $fillable = ['id', 'apelido'];

    public function pedidos()
    {
        return $this->hasMany(MLPedido::class, 'comprador_id');
    }

    public function pagamentos()
    {
        return $this->hasMany(MLPagamento::class, 'pagador_id');
    }
}
