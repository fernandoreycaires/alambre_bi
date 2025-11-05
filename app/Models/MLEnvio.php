<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MLEnvio extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "ml_envios";

    protected $fillable = ['id'];

    public function pedido()
    {
        return $this->hasOne(MLPedido::class, 'envio_id');
    }
}

