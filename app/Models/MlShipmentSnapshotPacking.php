<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlShipmentSnapshotPacking extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "ml_shipment_snapshot_packings";

    protected $fillable = [
        'id_ml',
        'snapshot_id',
        'pack_hash',
    ];

    public function shipment()
    {
        return $this->hasOne(MlShipment::class, 'snapshot_packing_id');
    }
}
