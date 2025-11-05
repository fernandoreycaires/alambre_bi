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
        Schema::create('ml_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('id_ml')->nullable();
            $table->string('role')->nullable(); // sender | receiver | etc.

            $table->string('country_id', 10)->nullable();
            $table->string('country_name')->nullable();
            $table->string('state_id', 20)->nullable();
            $table->string('state_name')->nullable();
            $table->string('city_id', 50)->nullable();
            $table->string('city_name')->nullable();

            $table->string('geolocation_type')->nullable();
            $table->decimal('latitude', 12, 6)->nullable();
            $table->decimal('longitude', 12, 6)->nullable();
            $table->string('geolocation_source')->nullable();
            $table->timestampTz('geolocation_last_updated')->nullable();

            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('address_line')->nullable();
            $table->string('street_name')->nullable();
            $table->string('street_number')->nullable();
            $table->string('zip_code', 30)->nullable();
            $table->string('neighborhood_name')->nullable();
            $table->string('municipality_name')->nullable();
            $table->string('intersection')->nullable();
            $table->string('comment')->nullable();

            $table->string('receiver_name')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('delivery_preference')->nullable();

            $table->integer('scoring')->nullable();

            $table->string('agency')->nullable();
            $table->string('agency_carrier_id')->nullable();
            $table->string('agency_phone')->nullable();
            $table->string('agency_agency_id')->nullable();
            $table->string('agency_description')->nullable();
            $table->string('agency_type')->nullable();
            $table->string('agency_open_hours')->nullable();

            $table->string('version')->nullable();
            $table->string('node')->nullable();
            $table->string('node_logistic_center_id')->nullable();
            $table->string('node_node_id')->nullable();

            // $table->string('types_id')->nullable(); // ["billing","shipping",...]
            // $table->foreignUuid('types_id')->nullable()->constrained('ml_shipment_types')->cascadeOnDelete(); // ["billing","shipping",...]

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_addresses');
    }
};
