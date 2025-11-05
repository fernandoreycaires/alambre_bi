<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MLImposto extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "ml_impostos";

    protected $fillable = ['id', 'valor', 'moeda_id'];

    public function pedido()
    {
        return $this->hasOne(MLPedido::class, 'imposto_id');
    }
}
