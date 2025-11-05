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
        Schema::create('ml_shipment_shipping_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('id_ml');

            $table->integer('processing_time')->nullable();
            $table->decimal('cost', 12, 2)->default(0);
            $table->string('shipping_method_id')->nullable();
            $table->string('name')->nullable();
            $table->string('priority_class_id', 10)->nullable();

            $table->string('delivery_promise')->nullable();
            $table->string('delivery_type')->nullable();

            $table->timestampTz('estimated_schedule_limit_date')->nullable();
            $table->timestampTz('estimated_delivery_final_date')->nullable();
            $table->timestampTz('estimated_delivery_limit_date')->nullable();
            $table->timestampTz('estimated_delivery_extended_date')->nullable();

            $table->timestampTz('edt_date')->nullable();
            $table->timestampTz('edt_pay_before')->nullable();
            $table->float('edt_schedule')->nullable();
            $table->string('edt_unit', 20)->nullable();
            $table->integer('edt_shipping')->nullable();
            $table->integer('edt_handling')->nullable();
            $table->string('edt_type', 50)->nullable();

            $table->timestampTz('edt_offset_date')->nullable();
            $table->integer('edt_offset_shipping')->nullable();

            $table->string('edt_time_frame_from')->nullable();
            $table->string('edt_time_frame_to')->nullable();

            $table->string('pickup_promise_from')->nullable();
            $table->string('pickup_promise_to')->nullable();
            $table->string('desired_promised_delivery_from')->nullable();
            $table->timestampTz('buffering_date')->nullable();

            $table->decimal('list_cost', 12, 2)->default(0);
            $table->string('currency_id', 10)->nullable();

            $table->unsignedBigInteger('external_id')->nullable(); // 4147005888
            $table->json('extra_json')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_shipment_shipping_options');
    }
};
