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
        Schema::create('ml_shipment_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_ml');
            $table->foreignUuid('shipment_id')->constrained('ml_shipments')->cascadeOnDelete();

            $table->integer('quantity')->default(1);
            $table->string('description')->nullable();
            $table->string('item_id')->nullable();         // ex: MLB3563180585
            $table->string('user_product_id')->nullable(); // ex: MLBU766036005
            $table->unsignedBigInteger('sender_ml_id')->nullable();

            $table->string('dimensions')->nullable(); // "4.0x17.0x83.0,1500.0"
            $table->string('dimensions_source_origin')->nullable(); // similarity
            $table->string('dimensions_source_id')->nullable();     // MLB...__1

            $table->json('bundle')->nullable();

            $table->timestamps();
            $table->index('item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_shipment_items');
    }
};
