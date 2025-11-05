<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MLAcaoDisponivelPagamento extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = "ml_acoes_disponiveis_pagamento";

    protected $fillable = ['id', 'pagamento_id', 'acao'];

    public function pagamento()
    {
        return $this->belongsTo(MLPagamento::class, 'pagamento_id');
    }
}
