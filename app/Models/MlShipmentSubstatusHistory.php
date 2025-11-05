<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlShipmentSubstatusHistory extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "ml_shipment_substatus_history";

    protected $fillable = [
        'id_ml',
        'shipment_id',
        'date',
        'status',
        'substatus',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function shipment()
    {
        return $this->belongsTo(MlShipment::class, 'shipment_id');
    }
}
