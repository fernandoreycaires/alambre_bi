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
        Schema::create('ml_shipment_status_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('id_ml');
            $table->timestampTz('date_shipped')->nullable();
            $table->timestampTz('date_returned')->nullable();
            $table->timestampTz('date_delivered')->nullable();
            $table->timestampTz('date_first_visit')->nullable();
            $table->timestampTz('date_not_delivered')->nullable();
            $table->timestampTz('date_cancelled')->nullable();
            $table->timestampTz('date_handling')->nullable();
            $table->timestampTz('date_ready_to_ship')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_shipment_status_histories');
    }
};
