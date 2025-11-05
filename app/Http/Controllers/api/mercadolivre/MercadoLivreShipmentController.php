<?php

namespace App\Http\Controllers\api\mercadolivre;

use App\Http\Controllers\Controller;
use App\Models\MlShipment;
use App\Models\MlAddress;
use App\Models\MlShipmentSnapshotPacking;
use App\Models\MlShipmentStatusHistory;
use App\Models\MlShipmentCostComponent;
use App\Models\MlShipmentShippingOption;
use App\Models\MlShipmentSibling;
use App\Models\MlShipmentSubstatusHistory;
use App\Models\MlShipmentItem;
use App\Models\MlShipmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MercadoLivreShipmentController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados do JSON
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'nullable|string|max:50',
            'substatus' => 'nullable|string|max:255',
            'order_id' => 'nullable',
            'receiver_id' => 'nullable',
            'sender_id' => 'nullable',
            'service_id' => 'nullable',
            'type' => 'nullable|string|max:50',
            'mode' => 'nullable|string|max:50',
            'tracking_number' => 'nullable|string|max:255',
            'tracking_method' => 'nullable|string|max:255',
            'logistic_type' => 'nullable|string|max:50',
            'market_place' => 'nullable|string|max:50',
            'site_id' => 'nullable|string|max:10',
            'base_cost' => 'nullable|numeric',
            'order_cost' => 'nullable|numeric',
            'priority_class.id' => 'nullable',
            'items_types' => 'nullable|array',
            'tags' => 'nullable|array',
            'created_by' => 'nullable|string|max:50',
            'application_id' => 'nullable',
            'date_created' => 'nullable|date',
            'date_first_printed' => 'nullable|date',
            'last_updated' => 'nullable|date',
            'return_details' => 'nullable',
            'return_tracking_number' => 'nullable|string|max:255',
            'customer_id' => 'nullable',
            'sender_address' => 'required|array',
            'sender_address.id' => 'nullable',
            'sender_address.country.id' => 'nullable|string|max:10',
            'sender_address.country.name' => 'nullable|string|max:255',
            'sender_address.state.id' => 'nullable|string|max:10',
            'sender_address.state.name' => 'nullable|string|max:255',
            'sender_address.city.id' => 'nullable|string|max:50',
            'sender_address.city.name' => 'nullable|string|max:255',
            'sender_address.geolocation_type' => 'nullable|string|max:50',
            'sender_address.latitude' => 'nullable|numeric',
            'sender_address.longitude' => 'nullable|numeric',
            'sender_address.geolocation_source' => 'nullable|string|max:50',
            'sender_address.geolocation_last_updated' => 'nullable|date',
            'sender_address.location_id' => 'nullable',
            'sender_address.address_line' => 'nullable|string|max:255',
            'sender_address.street_name' => 'nullable|string|max:255',
            'sender_address.street_number' => 'nullable|string|max:50',
            'sender_address.zip_code' => 'nullable|string|max:20',
            'sender_address.neighborhood.name' => 'nullable|string|max:255',
            'sender_address.municipality.name' => 'nullable|string|max:255',
            'sender_address.intersection' => 'nullable|string|max:255',
            'sender_address.comment' => 'nullable|string|max:255',
            'sender_address.scoring' => 'nullable|numeric',
            'sender_address.agency' => 'nullable|array',
            'sender_address.agency.carrier_id' => 'nullable',
            'sender_address.agency.phone' => 'nullable|string|max:50',
            'sender_address.agency.agency_id' => 'nullable|string|max:50',
            'sender_address.agency.description' => 'nullable|string|max:255',
            'sender_address.agency.type' => 'nullable|string|max:50',
            'sender_address.agency.open_hours' => 'nullable|string|max:255',
            'sender_address.version' => 'nullable|string|max:50',
            'sender_address.node' => 'nullable|array',
            'sender_address.node.logistic_center_id' => 'nullable|string|max:50',
            'sender_address.node.node_id' => 'nullable|string|max:50',
            'sender_address.types' => 'nullable|array',
            'sender_address.types.*' => 'string|max:255',
            'receiver_address' => 'required|array',
            'receiver_address.id' => 'nullable',
            'receiver_address.country.id' => 'nullable|string|max:10',
            'receiver_address.country.name' => 'nullable|string|max:255',
            'receiver_address.state.id' => 'nullable|string|max:10',
            'receiver_address.state.name' => 'nullable|string|max:255',
            'receiver_address.city.id' => 'nullable|string|max:50',
            'receiver_address.city.name' => 'nullable|string|max:255',
            'receiver_address.geolocation_type' => 'nullable|string|max:50',
            'receiver_address.latitude' => 'nullable|numeric',
            'receiver_address.longitude' => 'nullable|numeric',
            'receiver_address.geolocation_source' => 'nullable|string|max:50',
            'receiver_address.geolocation_last_updated' => 'nullable|date',
            'receiver_address.location_id' => 'nullable',
            'receiver_address.address_line' => 'nullable|string|max:255',
            'receiver_address.street_name' => 'nullable|string|max:255',
            'receiver_address.street_number' => 'nullable|string|max:50',
            'receiver_address.zip_code' => 'nullable|string|max:20',
            'receiver_address.neighborhood.name' => 'nullable|string|max:255',
            'receiver_address.municipality.name' => 'nullable|string|max:255',
            'receiver_address.intersection' => 'nullable|string|max:255',
            'receiver_address.comment' => 'nullable|string|max:255',
            'receiver_address.receiver_name' => 'nullable|string|max:255',
            'receiver_address.receiver_phone' => 'nullable|string|max:50',
            'receiver_address.delivery_preference' => 'nullable|string|max:50',
            'receiver_address.scoring' => 'nullable|numeric',
            'receiver_address.agency' => 'nullable|array',
            'receiver_address.agency.carrier_id' => 'nullable',
            'receiver_address.agency.phone' => 'nullable|string|max:50',
            'receiver_address.agency.agency_id' => 'nullable|string|max:50',
            'receiver_address.agency.description' => 'nullable|string|max:255',
            'receiver_address.agency.type' => 'nullable|string|max:50',
            'receiver_address.agency.open_hours' => 'nullable|string|max:255',
            'receiver_address.version' => 'nullable|string|max:50',
            'receiver_address.node' => 'nullable|array',
            'receiver_address.node.logistic_center_id' => 'nullable|string|max:50',
            'receiver_address.node.node_id' => 'nullable|string|max:50',
            'receiver_address.types' => 'nullable|array',
            'receiver_address.types.*' => 'string|max:255',
            'snapshot_packing' => 'required|array',
            'snapshot_packing.snapshot_id' => 'nullable|string|max:255',
            'snapshot_packing.pack_hash' => 'nullable|string|max:255',
            'status_history' => 'required|array',
            'status_history.date_shipped' => 'nullable|date',
            'status_history.date_returned' => 'nullable|date',
            'status_history.date_delivered' => 'nullable|date',
            'status_history.date_first_visit' => 'nullable|date',
            'status_history.date_not_delivered' => 'nullable|date',
            'status_history.date_cancelled' => 'nullable|date',
            'status_history.date_handling' => 'nullable|date',
            'status_history.date_ready_to_ship' => 'nullable|date',
            'cost_components' => 'required|array',
            'cost_components.loyal_discount' => 'nullable|numeric',
            'cost_components.special_discount' => 'nullable|numeric',
            'cost_components.compensation' => 'nullable|numeric',
            'cost_components.gap_discount' => 'nullable|numeric',
            'cost_components.ratio' => 'nullable|numeric',
            'shipping_option' => 'required|array',
            'shipping_option.id' => 'nullable',
            'shipping_option.processing_time' => 'nullable',
            'shipping_option.cost' => 'nullable|numeric',
            'shipping_option.shipping_method_id' => 'nullable',
            'shipping_option.name' => 'nullable|string|max:255',
            'shipping_option.priority_class.id' => 'nullable',
            'shipping_option.delivery_promise' => 'nullable|string|max:50',
            'shipping_option.delivery_type' => 'nullable|string|max:50',
            'shipping_option.estimated_schedule_limit.date' => 'nullable|date',
            'shipping_option.estimated_delivery_final.date' => 'nullable|date',
            'shipping_option.estimated_delivery_limit.date' => 'nullable|date',
            'shipping_option.estimated_delivery_extended.date' => 'nullable|date',
            'shipping_option.estimated_delivery_time.date' => 'nullable|date',
            'shipping_option.estimated_delivery_time.pay_before' => 'nullable|date',
            'shipping_option.estimated_delivery_time.schedule' => 'nullable|numeric',
            'shipping_option.estimated_delivery_time.unit' => 'nullable|string|max:50',
            'shipping_option.estimated_delivery_time.shipping' => 'nullable|numeric',
            'shipping_option.estimated_delivery_time.handling' => 'nullable|numeric',
            'shipping_option.estimated_delivery_time.type' => 'nullable|string|max:50',
            'shipping_option.estimated_delivery_time.offset.date' => 'nullable|date',
            'shipping_option.estimated_delivery_time.offset.shipping' => 'nullable|numeric',
            'shipping_option.estimated_delivery_time.time_frame.from' => 'nullable|date',
            'shipping_option.estimated_delivery_time.time_frame.to' => 'nullable|date',
            'shipping_option.pickup_promise.from' => 'nullable|date',
            'shipping_option.pickup_promise.to' => 'nullable|date',
            'shipping_option.desired_promised_delivery.from' => 'nullable|date',
            'shipping_option.buffering.date' => 'nullable|date',
            'shipping_option.list_cost' => 'nullable|numeric',
            'shipping_option.currency_id' => 'nullable|string|max:10',
            'sibling' => 'required|array',
            'sibling.reason' => 'nullable|string|max:255',
            'sibling.sibling_id' => 'nullable',
            'sibling.description' => 'nullable|string|max:255',
            'sibling.source' => 'nullable|string|max:255',
            'sibling.date_created' => 'nullable|date',
            'sibling.last_updated' => 'nullable|date',
            'shipping_items' => 'nullable|array',
            'shipping_items.*.id' => 'nullable|string|max:50',
            'shipping_items.*.quantity' => 'nullable|integer',
            'shipping_items.*.description' => 'nullable|string|max:255',
            'shipping_items.*.user_product_id' => 'nullable|string|max:50',
            'shipping_items.*.sender_id' => 'nullable',
            'shipping_items.*.dimensions' => 'nullable|string|max:255',
            'shipping_items.*.dimensions_source.origin' => 'nullable|string|max:50',
            'shipping_items.*.dimensions_source.id' => 'nullable|string|max:50',
            'shipping_items.*.bundle' => 'nullable',
            'substatus_history' => 'nullable|array',
            'substatus_history.*.date' => 'nullable|date',
            'substatus_history.*.status' => 'nullable|string|max:50',
            'substatus_history.*.substatus' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors(),
            ], 422);
        }

        try {
            return DB::transaction(function () use ($request) {
                $shipmentData = $request->all();

                // Verifica se o shipment já existe
                $existingShipment = MlShipment::where('id_ml', $shipmentData['id'])->first();
                if ($existingShipment) {
                    return response()->json([
                        'message' => 'Shipment already in database',
                        'shipment_id_ml' => $shipmentData['id'],
                        'shipment_id' => $existingShipment->id,
                    ], 200);
                }

                // --- Endereço Sender ---
                $senderAddressData = $shipmentData['sender_address'] ?? [];
                $senderAgencyData = $senderAddressData['agency'] ?? [];
                $senderNodeData = $senderAddressData['node'] ?? [];
                $senderAddress = new MlAddress();
                $senderAddress->id = (string) Str::uuid();
                $senderAddress->id_ml = $senderAddressData['id'] ?? null;
                $senderAddress->role = 'sender';
                $senderAddress->country_id = $senderAddressData['country']['id'] ?? null;
                $senderAddress->country_name = $senderAddressData['country']['name'] ?? null;
                $senderAddress->state_id = $senderAddressData['state']['id'] ?? null;
                $senderAddress->state_name = $senderAddressData['state']['name'] ?? null;
                $senderAddress->city_id = $senderAddressData['city']['id'] ?? null;
                $senderAddress->city_name = $senderAddressData['city']['name'] ?? null;
                $senderAddress->geolocation_type = $senderAddressData['geolocation_type'] ?? null;
                $senderAddress->latitude = $senderAddressData['latitude'] ?? null;
                $senderAddress->longitude = $senderAddressData['longitude'] ?? null;
                $senderAddress->geolocation_source = $senderAddressData['geolocation_source'] ?? null;
                $senderAddress->geolocation_last_updated = $senderAddressData['geolocation_last_updated'] ?? null;
                $senderAddress->location_id = $senderAddressData['location_id'] ?? null;
                $senderAddress->address_line = $senderAddressData['address_line'] ?? null;
                $senderAddress->street_name = $senderAddressData['street_name'] ?? null;
                $senderAddress->street_number = $senderAddressData['street_number'] ?? null;
                $senderAddress->zip_code = $senderAddressData['zip_code'] ?? null;
                $senderAddress->neighborhood_name = $senderAddressData['neighborhood']['name'] ?? null;
                $senderAddress->municipality_name = $senderAddressData['municipality']['name'] ?? null;
                $senderAddress->intersection = $senderAddressData['intersection'] ?? null;
                $senderAddress->comment = $senderAddressData['comment'] ?? null;
                $senderAddress->scoring = $senderAddressData['scoring'] ?? null;
                $senderAddress->agency = $senderAgencyData ? null : ($senderAddressData['agency'] ?? null);
                $senderAddress->agency_carrier_id = $senderAgencyData['carrier_id'] ?? null;
                $senderAddress->agency_phone = $senderAgencyData['phone'] ?? null;
                $senderAddress->agency_agency_id = $senderAgencyData['agency_id'] ?? null;
                $senderAddress->agency_description = $senderAgencyData['description'] ?? null;
                $senderAddress->agency_type = $senderAgencyData['type'] ?? null;
                $senderAddress->agency_open_hours = $senderAgencyData['open_hours'] ?? null;
                $senderAddress->version = $senderAddressData['version'] ?? null;
                $senderAddress->node = $senderNodeData ? null : ($senderAddressData['node'] ?? null);
                $senderAddress->node_logistic_center_id = $senderNodeData['logistic_center_id'] ?? null;
                $senderAddress->node_node_id = $senderNodeData['node_id'] ?? null;
                $senderAddress->save();

                // Criar tipos para sender_address
                foreach ($senderAddressData['types'] ?? [] as $type) {
                    $shipmentType = new MlShipmentType();
                    $shipmentType->id = (string) Str::uuid();
                    $shipmentType->address_id = $senderAddress->id;
                    $shipmentType->types = $type;
                    $shipmentType->save();
                }

                // --- Endereço Receiver ---
                $receiverAddressData = $shipmentData['receiver_address'] ?? [];
                $receiverAgencyData = $receiverAddressData['agency'] ?? [];
                $receiverNodeData = $receiverAddressData['node'] ?? [];
                $receiverAddress = new MlAddress();
                $receiverAddress->id = (string) Str::uuid();
                $receiverAddress->id_ml = $receiverAddressData['id'] ?? null;
                $receiverAddress->role = 'receiver';
                $receiverAddress->country_id = $receiverAddressData['country']['id'] ?? null;
                $receiverAddress->country_name = $receiverAddressData['country']['name'] ?? null;
                $receiverAddress->state_id = $receiverAddressData['state']['id'] ?? null;
                $receiverAddress->state_name = $receiverAddressData['state']['name'] ?? null;
                $receiverAddress->city_id = $receiverAddressData['city']['id'] ?? null;
                $receiverAddress->city_name = $receiverAddressData['city']['name'] ?? null;
                $receiverAddress->geolocation_type = $receiverAddressData['geolocation_type'] ?? null;
                $receiverAddress->latitude = $receiverAddressData['latitude'] ?? null;
                $receiverAddress->longitude = $receiverAddressData['longitude'] ?? null;
                $receiverAddress->geolocation_source = $receiverAddressData['geolocation_source'] ?? null;
                $receiverAddress->geolocation_last_updated = $receiverAddressData['geolocation_last_updated'] ?? null;
                $receiverAddress->location_id = $receiverAddressData['location_id'] ?? null;
                $receiverAddress->address_line = $receiverAddressData['address_line'] ?? null;
                $receiverAddress->street_name = $receiverAddressData['street_name'] ?? null;
                $receiverAddress->street_number = $receiverAddressData['street_number'] ?? null;
                $receiverAddress->zip_code = $receiverAddressData['zip_code'] ?? null;
                $receiverAddress->neighborhood_name = $receiverAddressData['neighborhood']['name'] ?? null;
                $receiverAddress->municipality_name = $receiverAddressData['municipality']['name'] ?? null;
                $receiverAddress->intersection = $receiverAddressData['intersection'] ?? null;
                $receiverAddress->comment = $receiverAddressData['comment'] ?? null;
                $receiverAddress->receiver_name = $receiverAddressData['receiver_name'] ?? null;
                $receiverAddress->receiver_phone = $receiverAddressData['receiver_phone'] ?? null;
                $receiverAddress->delivery_preference = $receiverAddressData['delivery_preference'] ?? null;
                $receiverAddress->scoring = $receiverAddressData['scoring'] ?? null;
                $receiverAddress->agency = $receiverAgencyData ? null : ($receiverAddressData['agency'] ?? null);
                $receiverAddress->agency_carrier_id = $receiverAgencyData['carrier_id'] ?? null;
                $receiverAddress->agency_phone = $receiverAgencyData['phone'] ?? null;
                $receiverAddress->agency_agency_id = $receiverAgencyData['agency_id'] ?? null;
                $receiverAddress->agency_description = $receiverAgencyData['description'] ?? null;
                $receiverAddress->agency_type = $receiverAgencyData['type'] ?? null;
                $receiverAddress->agency_open_hours = $receiverAgencyData['open_hours'] ?? null;
                $receiverAddress->version = $receiverAddressData['version'] ?? null;
                $receiverAddress->node = $receiverNodeData ? null : ($receiverAddressData['node'] ?? null);
                $receiverAddress->node_logistic_center_id = $receiverNodeData['logistic_center_id'] ?? null;
                $receiverAddress->node_node_id = $receiverNodeData['node_id'] ?? null;
                $receiverAddress->save();

                // Criar tipos para receiver_address
                foreach ($receiverAddressData['types'] ?? [] as $type) {
                    $shipmentType = new MlShipmentType();
                    $shipmentType->id = (string) Str::uuid();
                    $shipmentType->address_id = $receiverAddress->id;
                    $shipmentType->types = $type;
                    $shipmentType->save();
                }

                // --- Snapshot Packing ---
                $snapshotPackingData = $shipmentData['snapshot_packing'] ?? [];
                $snapshotPacking = new MlShipmentSnapshotPacking();
                $snapshotPacking->id = (string) Str::uuid();
                $snapshotPacking->id_ml = $shipmentData['id'] ?? null;
                $snapshotPacking->snapshot_id = $snapshotPackingData['snapshot_id'] ?? null;
                $snapshotPacking->pack_hash = $snapshotPackingData['pack_hash'] ?? null;
                $snapshotPacking->save();

                // --- Status History ---
                $statusHistoryData = $shipmentData['status_history'] ?? [];
                $statusHistory = new MlShipmentStatusHistory();
                $statusHistory->id = (string) Str::uuid();
                $statusHistory->id_ml = $shipmentData['id'] ?? null;
                $statusHistory->date_shipped = $statusHistoryData['date_shipped'] ?? null;
                $statusHistory->date_returned = $statusHistoryData['date_returned'] ?? null;
                $statusHistory->date_delivered = $statusHistoryData['date_delivered'] ?? null;
                $statusHistory->date_first_visit = $statusHistoryData['date_first_visit'] ?? null;
                $statusHistory->date_not_delivered = $statusHistoryData['date_not_delivered'] ?? null;
                $statusHistory->date_cancelled = $statusHistoryData['date_cancelled'] ?? null;
                $statusHistory->date_handling = $statusHistoryData['date_handling'] ?? null;
                $statusHistory->date_ready_to_ship = $statusHistoryData['date_ready_to_ship'] ?? null;
                $statusHistory->save();

                // --- Cost Components ---
                $costComponentsData = $shipmentData['cost_components'] ?? [];
                $costComponents = new MlShipmentCostComponent();
                $costComponents->id = (string) Str::uuid();
                $costComponents->id_ml = $shipmentData['id'] ?? null;
                $costComponents->loyal_discount = $costComponentsData['loyal_discount'] ?? 0;
                $costComponents->special_discount = $costComponentsData['special_discount'] ?? 0;
                $costComponents->compensation = $costComponentsData['compensation'] ?? 0;
                $costComponents->gap_discount = $costComponentsData['gap_discount'] ?? 0;
                $costComponents->ratio = $costComponentsData['ratio'] ?? 0;
                $costComponents->save();

 
                // --- Shipping Option ---
                $shippingOptionData = $shipmentData['shipping_option'] ?? [];
                $edtData = $shippingOptionData['estimated_delivery_time'] ?? [];
                $offsetData = $edtData['offset'] ?? [];
                $timeFrameData = $edtData['time_frame'] ?? [];

                $shippingOption = new MlShipmentShippingOption();
                $shippingOption->id = (string) Str::uuid();
                $shippingOption->id_ml = $shipmentData['id'] ?? null;
                $shippingOption->processing_time = $shippingOptionData['processing_time'] ?? null;
                $shippingOption->cost = $shippingOptionData['cost'] ?? 0;
                $shippingOption->shipping_method_id = $shippingOptionData['shipping_method_id'] ?? null;
                $shippingOption->name = $shippingOptionData['name'] ?? null;
                $shippingOption->priority_class_id = $shippingOptionData['priority_class']['id'] ?? null;
                $shippingOption->delivery_promise = $shippingOptionData['delivery_promise'] ?? null;
                $shippingOption->delivery_type = $shippingOptionData['delivery_type'] ?? null;
                $shippingOption->estimated_schedule_limit_date = $shippingOptionData['estimated_schedule_limit']['date'] ?? null;
                $shippingOption->estimated_delivery_final_date = $shippingOptionData['estimated_delivery_final']['date'] ?? null;
                $shippingOption->estimated_delivery_limit_date = $shippingOptionData['estimated_delivery_limit']['date'] ?? null;
                $shippingOption->estimated_delivery_extended_date = $shippingOptionData['estimated_delivery_extended']['date'] ?? null;
                $shippingOption->edt_date = $edtData['date'] ?? null;
                $shippingOption->edt_pay_before = $edtData['pay_before'] ?? null;
                $shippingOption->edt_schedule = $edtData['schedule'] ?? null;
                $shippingOption->edt_unit = $edtData['unit'] ?? null;
                $shippingOption->edt_shipping = $edtData['shipping'] ?? null;
                $shippingOption->edt_handling = $edtData['handling'] ?? null;
                $shippingOption->edt_type = $edtData['type'] ?? null;
                $shippingOption->edt_offset_date = $offsetData['date'] ?? null;
                $shippingOption->edt_offset_shipping = $offsetData['shipping'] ?? null;
                $shippingOption->edt_time_frame_from = $timeFrameData['from'] ?? null;
                $shippingOption->edt_time_frame_to = $timeFrameData['to'] ?? null;
                $shippingOption->pickup_promise_from = $shippingOptionData['pickup_promise']['from'] ?? null;
                $shippingOption->pickup_promise_to = $shippingOptionData['pickup_promise']['to'] ?? null;
                $shippingOption->desired_promised_delivery_from = $shippingOptionData['desired_promised_delivery']['from'] ?? null;
                $shippingOption->buffering_date = $shippingOptionData['buffering']['date'] ?? null;
                $shippingOption->list_cost = $shippingOptionData['list_cost'] ?? 0;
                $shippingOption->currency_id = $shippingOptionData['currency_id'] ?? null;
                $shippingOption->external_id = $shippingOptionData['id'] ?? null;
                $shippingOption->extra_json = $shippingOptionData ?? null;
                $shippingOption->save();

      
                // --- Sibling ---
                $siblingData = $shipmentData['sibling'] ?? [];
                $sibling = new MlShipmentSibling();
                $sibling->id = (string) Str::uuid();
                $sibling->id_ml = $shipmentData['id'] ?? null;
                $sibling->reason = $siblingData['reason'] ?? null;
                $sibling->sibling_id = $siblingData['sibling_id'] ?? null;
                $sibling->description = $siblingData['description'] ?? null;
                $sibling->source = $siblingData['source'] ?? null;
                $sibling->date_created = $siblingData['date_created'] ?? null;
                $sibling->last_updated = $siblingData['last_updated'] ?? null;
                $sibling->save();


                // --- Shipment ---
                $shipment = new MlShipment();
                $shipment->id = (string) Str::uuid();
                $shipment->id_ml = $shipmentData['id'] ?? null;
                $shipment->sender_address_id = $senderAddress->id;
                $shipment->receiver_address_id = $receiverAddress->id;
                $shipment->snapshot_packing_id = $snapshotPacking->id;
                $shipment->status_history_id = $statusHistory->id;
                $shipment->cost_components_id = $costComponents->id;
                $shipment->shipping_option_id = $shippingOption->id;
                $shipment->sibling_id = $sibling->id;
                $shipment->receiver_ml_id = $shipmentData['receiver_id'] ?? null;
                $shipment->sender_ml_id = $shipmentData['sender_id'] ?? null;
                $shipment->order_ml_id = $shipmentData['order_id'] ?? null;
                $shipment->service_ml_id = $shipmentData['service_id'] ?? null;
                $shipment->type = $shipmentData['type'] ?? null;
                $shipment->mode = $shipmentData['mode'] ?? null;
                $shipment->status = $shipmentData['status'] ?? null;
                $shipment->substatus = $shipmentData['substatus'] ?? null;
                $shipment->tracking_number = $shipmentData['tracking_number'] ?? null;
                $shipment->tracking_method = $shipmentData['tracking_method'] ?? null;
                $shipment->logistic_type = $shipmentData['logistic_type'] ?? null;
                $shipment->market_place = $shipmentData['market_place'] ?? null;
                $shipment->site_id = $shipmentData['site_id'] ?? null;
                $shipment->base_cost = $shipmentData['base_cost'] ?? 0;
                $shipment->order_cost = $shipmentData['order_cost'] ?? 0;
                $shipment->priority_class_id = $shipmentData['priority_class']['id'] ?? null;
                $shipment->items_types = $shipmentData['items_types'] ?? null;
                $shipment->tags = $shipmentData['tags'] ?? null;
                $shipment->created_by = $shipmentData['created_by'] ?? null;
                $shipment->application_id = $shipmentData['application_id'] ?? null;
                $shipment->date_created = $shipmentData['date_created'] ?? null;
                $shipment->date_first_printed = $shipmentData['date_first_printed'] ?? null;
                $shipment->last_updated = $shipmentData['last_updated'] ?? null;
                $shipment->return_details = $shipmentData['return_details'] ?? null;
                $shipment->return_tracking_number = $shipmentData['return_tracking_number'] ?? null;
                $shipment->customer_ml_id = $shipmentData['customer_id'] ?? null;
                $shipment->save();

          
                // --- Shipping Items ---
                foreach ($shipmentData['shipping_items'] ?? [] as $itemData) {

                    $itensShip = new MlShipmentItem();
                    $itensShip->id = (string) Str::uuid();
                    $itensShip->id_ml = $itemData['id'] ?? null;
                    $itensShip->shipment_id = $shipment->id;
                    $itensShip->quantity = $itemData['quantity'] ?? 1;
                    $itensShip->description = $itemData['description'] ?? null;
                    $itensShip->item_id = $itemData['id'] ?? null;
                    $itensShip->user_product_id = $itemData['user_product_id'] ?? null;
                    $itensShip->sender_ml_id = $itemData['sender_id'] ?? null;
                    $itensShip->dimensions = $itemData['dimensions'] ?? null;
                    $itensShip->dimensions_source_origin = $itemData['dimensions_source']['origin'] ?? null;
                    $itensShip->dimensions_source_id = $itemData['dimensions_source']['id'] ?? null;
                    $itensShip->bundle = $itemData['bundle'] ?? null;
                    $itensShip->save();

                }

                // --- Substatus History ---
                foreach ($shipmentData['substatus_history'] ?? [] as $subHistory) {

                    $substatus_history = new MlShipmentSubstatusHistory();
                    $substatus_history->id = (string) Str::uuid();
                    $substatus_history->id_ml = $shipmentData['id'] ?? null;
                    $substatus_history->shipment_id = $shipment->id;
                    $substatus_history->date = $subHistory['date'] ?? null;
                    $substatus_history->status = $subHistory['status'] ?? null;
                    $substatus_history->substatus = $subHistory['substatus'] ?? null;
                    $substatus_history->save();
                }

                return response()->json([
                    'message' => 'Shipment created successfully',
                    'shipment_id' => $shipment->id,
                    'shipment_id_ml' => $shipmentData['id'],
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create shipment',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
