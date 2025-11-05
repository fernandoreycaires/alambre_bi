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
        Schema::create('ml_shipment_snapshot_packings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('id_ml');
            $table->uuid('snapshot_id')->nullable();
            $table->string('pack_hash')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_shipment_snapshot_packings');
    }
};
