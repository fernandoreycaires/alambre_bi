<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlShipmentStatusHistory extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "ml_shipment_status_histories";

    protected $fillable = [
        'id_ml',
        'date_shipped',
        'date_returned',
        'date_delivered',
        'date_first_visit',
        'date_not_delivered',
        'date_cancelled',
        'date_handling',
        'date_ready_to_ship',
    ];

    protected $casts = [
        'date_shipped' => 'datetime',
        'date_returned' => 'datetime',
        'date_delivered' => 'datetime',
        'date_first_visit' => 'datetime',
        'date_not_delivered' => 'datetime',
        'date_cancelled' => 'datetime',
        'date_handling' => 'datetime',
        'date_ready_to_ship' => 'datetime',
    ];

    public function shipment()
    {
        return $this->hasOne(MlShipment::class, 'status_history_id');
    }
}
