<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MlShipment extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = "ml_shipments";

    protected $fillable = [
        'id_ml',
        'sender_address_id',
        'receiver_address_id',
        'snapshot_packing_id',
        'status_history_id',
        'cost_components_id',
        'shipping_option_id',
        'sibling_id',
        'receiver_ml_id',
        'sender_ml_id',
        'order_ml_id',
        'service_ml_id',
        'type',
        'mode',
        'status',
        'substatus',
        'tracking_number',
        'tracking_method',
        'logistic_type',
        'market_place',
        'site_id',
        'base_cost',
        'order_cost',
        'priority_class_id',
        'items_types',
        'tags',
        'created_by',
        'application_id',
        'date_created',
        'date_first_printed',
        'last_updated',
        'return_details',
        'return_tracking_number',
        'customer_ml_id',
    ];

    protected $casts = [
        'items_types' => 'array',
        'tags' => 'array',
        'return_details' => 'array',
        'base_cost' => 'decimal:2',
        'order_cost' => 'decimal:2',
        'date_created' => 'datetime',
        'date_first_printed' => 'datetime',
        'last_updated' => 'datetime',
    ];

    public function senderAddress()
    {
        return $this->belongsTo(MlAddress::class, 'sender_address_id');
    }

    public function receiverAddress()
    {
        return $this->belongsTo(MlAddress::class, 'receiver_address_id');
    }

    public function snapshotPacking()
    {
        return $this->belongsTo(MlShipmentSnapshotPacking::class, 'snapshot_packing_id');
    }

    public function statusHistory()
    {
        return $this->belongsTo(MlShipmentStatusHistory::class, 'status_history_id');
    }

    public function costComponents()
    {
        return $this->belongsTo(MlShipmentCostComponent::class, 'cost_components_id');
    }

    public function shippingOption()
    {
        return $this->belongsTo(MlShipmentShippingOption::class, 'shipping_option_id');
    }

    public function sibling()
    {
        return $this->belongsTo(MlShipmentSibling::class, 'sibling_id');
    }

    public function substatusHistories()
    {
        return $this->hasMany(MlShipmentSubstatusHistory::class, 'shipment_id');
    }

    public function items()
    {
        return $this->hasMany(MlShipmentItem::class, 'shipment_id');
    }
}
