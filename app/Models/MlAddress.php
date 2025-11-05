<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlAddress extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "ml_addresses";

    protected $fillable = [
        'id_ml',
        'role',
        'country_id',
        'country_name',
        'state_id',
        'state_name',
        'city_id',
        'city_name',
        'geolocation_type',
        'latitude',
        'longitude',
        'geolocation_source',
        'geolocation_last_updated',
        'location_id',
        'address_line',
        'street_name',
        'street_number',
        'zip_code',
        'neighborhood_name',
        'municipality_name',
        'intersection',
        'comment',
        'receiver_name',
        'receiver_phone',
        'delivery_preference',
        'scoring',
        'agency',
        'agency_carrier_id',
        'agency_phone',
        'agency_agency_id',
        'agency_description',
        'agency_type',
        'agency_open_hours',
        'version',
        'node',
        'node_logistic_center_id',
        'node_node_id',
        'types',
    ];

    protected $casts = [
        'types' => 'array',
        'geolocation_last_updated' => 'datetime',
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6',
    ];

    public function shipmentsAsSender()
    {
        return $this->hasMany(MlShipment::class, 'sender_address_id');
    }

    public function shipmentsAsReceiver()
    {
        return $this->hasMany(MlShipment::class, 'receiver_address_id');
    }

    public function shipmentsType()
    {
        return $this->hasMany(MlShipmentType::class, 'address_id');
    }
}
