<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlShipmentItem extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "ml_shipment_items";

    protected $fillable = [
        'id_ml',
        'shipment_id',
        'quantity',
        'description',
        'item_id',
        'user_product_id',
        'sender_ml_id',
        'dimensions',
        'dimensions_source_origin',
        'dimensions_source_id',
        'bundle',
    ];

    protected $casts = [
        'bundle' => 'array',
    ];

    public function shipment()
    {
        return $this->belongsTo(MlShipment::class, 'shipment_id');
    }
}
