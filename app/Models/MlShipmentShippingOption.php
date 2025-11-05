<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlShipmentShippingOption extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "ml_shipment_shipping_options";

    protected $fillable = [
        'id_ml',
        'processing_time',
        'cost',
        'shipping_method_id',
        'name',
        'priority_class_id',
        'delivery_promise',
        'delivery_type',
        'estimated_schedule_limit_date',
        'estimated_delivery_final_date',
        'estimated_delivery_limit_date',
        'estimated_delivery_extended_date',
        'edt_date',
        'edt_pay_before',
        'edt_schedule',
        'edt_unit',
        'edt_shipping',
        'edt_handling',
        'edt_type',
        'edt_offset_date',
        'edt_offset_shipping',
        'edt_time_frame_from',
        'edt_time_frame_to',
        'pickup_promise_from',
        'pickup_promise_to',
        'desired_promised_delivery_from',
        'buffering_date',
        'list_cost',
        'currency_id',
        'external_id',
        'extra_json',
    ];

    protected $casts = [
        'cost' => 'decimal:2',
        'list_cost' => 'decimal:2',
        'estimated_schedule_limit_date' => 'datetime',
        'estimated_delivery_final_date' => 'datetime',
        'estimated_delivery_limit_date' => 'datetime',
        'estimated_delivery_extended_date' => 'datetime',
        'edt_date' => 'datetime',
        'edt_pay_before' => 'datetime',
        'buffering_date' => 'datetime',
        'extra_json' => 'array',
    ];

    public function shipment()
    {
        return $this->hasOne(MlShipment::class, 'shipping_option_id');
    }
}
