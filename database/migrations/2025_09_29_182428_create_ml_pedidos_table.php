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
        Schema::create('ml_pedidos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('id_ml')->nullable();
            $table->timestamp('data_criacao')->nullable();
            $table->timestamp('data_fechamento')->nullable();
            $table->timestamp('data_ultima_atualizacao')->nullable();
            $table->timestamp('ultima_atualizacao')->nullable();
            $table->timestamp('data_expiracao')->nullable();
            $table->decimal('valor_total', 10, 2)->nullable();
            $table->decimal('valor_pago', 10, 2)->nullable();
            $table->string('moeda_id', 10)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('detalhe_status', 255)->nullable();
            $table->bigInteger('id_pacote')->nullable();
            $table->decimal('custo_envio', 10, 2)->nullable();
            $table->text('comentario')->nullable();
            $table->boolean('cumprido')->nullable();
            $table->foreignUuid('comprador_id')->nullable();
            $table->foreignUuid('vendedor_id')->nullable();
            $table->foreignUuid('envio_id')->nullable();
            $table->foreignUuid('cupom_id')->nullable();
            $table->foreignUuid('imposto_id')->nullable();

            $table->foreign('comprador_id')->references('id')->on('ml_compradores')->onDelete('set null');
            $table->foreign('vendedor_id')->references('id')->on('ml_vendedores')->onDelete('set null');
            $table->foreign('envio_id')->references('id')->on('ml_envios')->onDelete('set null');
            $table->foreign('cupom_id')->references('id')->on('ml_cupons')->onDelete('set null');
            $table->foreign('imposto_id')->references('id')->on('ml_impostos')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_pedidos');
    }
};
