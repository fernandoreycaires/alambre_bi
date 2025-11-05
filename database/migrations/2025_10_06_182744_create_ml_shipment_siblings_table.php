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
        Schema::create('ml_shipment_siblings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('id_ml');
            $table->string('reason')->nullable();
            $table->unsignedBigInteger('sibling_id')->nullable();
            $table->string('description')->nullable();
            $table->string('source')->nullable();
            $table->timestampTz('date_created')->nullable();
            $table->timestampTz('last_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_shipment_siblings');
    }
};
