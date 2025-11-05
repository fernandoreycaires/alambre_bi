<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlShipmentSibling extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "ml_shipment_siblings";

    protected $fillable = [
        'id_ml',
        'reason',
        'sibling_id',
        'description',
        'source',
        'date_created',
        'last_updated',
    ];

    protected $casts = [
        'date_created' => 'datetime',
        'last_updated' => 'datetime',
    ];

    public function shipment()
    {
        return $this->hasOne(MlShipment::class, 'sibling_id');
    }
}
