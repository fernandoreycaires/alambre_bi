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
        Schema::create('ml_acoes_disponiveis_pagamento', function (Blueprint $table) {
            $table->uuid('id');
            $table->bigInteger('id_ml')->nullable();
            $table->foreignUuid('pagamento_id');
            $table->string('acao', 50);
            
            $table->foreign('pagamento_id')->references('id')->on('ml_pagamentos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_acoes_disponiveis_pagamento');
    }
};
