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
        Schema::create('ml_shipment_types', function (Blueprint $table) {
            $table->uuid("id")->unique()->primary();
            $table->foreignUuid('address_id')->nullable()->constrained('ml_addresses')->cascadeOnDelete(); // ["billing","shipping",...]
            $table->string('types'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_shipment_types');
    }
};
