<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlShipmentCostComponent extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "ml_shipment_cost_components";

    protected $fillable = [
        'id_ml',
        'loyal_discount',
        'special_discount',
        'compensation',
        'gap_discount',
        'ratio',
    ];

    protected $casts = [
        'loyal_discount' => 'decimal:2',
        'special_discount' => 'decimal:2',
        'compensation' => 'decimal:2',
        'gap_discount' => 'decimal:2',
        'ratio' => 'decimal:2',
    ];

    public function shipment()
    {
        return $this->hasOne(MlShipment::class, 'cost_components_id');
    }
}
