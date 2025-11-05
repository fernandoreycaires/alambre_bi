<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlShipmentType extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "ml_shipment_types";

    public function typeAddress()
    {
        return $this->belongsTo(MlAddress::class, 'id');
    }

}
