<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ml_shipments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('id_ml');

            $table->foreignUuid('sender_address_id')->nullable()->constrained('ml_addresses')->nullOnDelete();
            $table->foreignUuid('receiver_address_id')->nullable()->constrained('ml_addresses')->nullOnDelete();

            $table->foreignUuid('snapshot_packing_id')->nullable()->constrained('ml_shipment_snapshot_packings')->nullOnDelete();
            $table->foreignUuid('status_history_id')->nullable()->constrained('ml_shipment_status_histories')->nullOnDelete();
            $table->foreignUuid('cost_components_id')->nullable()->constrained('ml_shipment_cost_components')->nullOnDelete();
            $table->foreignUuid('shipping_option_id')->nullable()->constrained('ml_shipment_shipping_options')->nullOnDelete();
            $table->foreignUuid('sibling_id')->nullable()->constrained('ml_shipment_siblings')->nullOnDelete();

            $table->unsignedBigInteger('receiver_ml_id')->nullable();
            $table->unsignedBigInteger('sender_ml_id')->nullable();
            $table->unsignedBigInteger('order_ml_id')->nullable();
            $table->unsignedBigInteger('service_ml_id')->nullable();

            $table->string('type', 50)->nullable();
            $table->string('mode', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('substatus', 100)->nullable();
            $table->string('tracking_number', 100)->nullable()->index();
            $table->string('tracking_method', 100)->nullable();
            $table->string('logistic_type', 100)->nullable();
            $table->string('market_place', 50)->nullable();
            $table->string('site_id', 10)->nullable();

            $table->decimal('base_cost', 12, 2)->default(0);
            $table->decimal('order_cost', 12, 2)->default(0);
            $table->string('priority_class_id', 10)->nullable();

            $table->json('items_types')->nullable();
            $table->json('tags')->nullable();

            $table->string('created_by')->nullable();
            $table->string('application_id')->nullable();

            $table->timestampTz('date_created')->nullable();
            $table->timestampTz('date_first_printed')->nullable();
            $table->timestampTz('last_updated')->nullable();

            $table->json('return_details')->nullable();
            $table->string('return_tracking_number')->nullable();
            $table->unsignedBigInteger('customer_ml_id')->nullable();

            $table->timestamps();

            $table->index(['status', 'substatus']);
            $table->index(['sender_ml_id', 'receiver_ml_id']);
            $table->index(['order_ml_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_shipments');
    }
};
