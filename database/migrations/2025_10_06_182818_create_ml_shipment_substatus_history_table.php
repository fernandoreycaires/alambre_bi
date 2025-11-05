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
        Schema::create('ml_shipment_substatus_history', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('id_ml');
            $table->foreignUuid('shipment_id')->constrained('ml_shipments')->cascadeOnDelete();
            $table->timestampTz('date')->index();
            $table->string('status', 50)->nullable();
            $table->string('substatus', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_shipment_substatus_history');
    }
};
