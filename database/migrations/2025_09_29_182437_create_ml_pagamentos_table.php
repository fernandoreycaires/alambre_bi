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
        Schema::create('ml_pagamentos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('id_ml')->nullable();
            $table->foreignUuid('pedido_id');
            $table->string('motivo', 255)->nullable();
            $table->string('codigo_status', 50)->nullable();
            $table->decimal('valor_total_pago', 10, 2)->nullable();
            $table->string('tipo_operacao', 50)->nullable();
            $table->decimal('valor_transacao', 10, 2)->nullable();
            $table->decimal('valor_transacao_reembolsado', 10, 2)->nullable();
            $table->timestamp('data_aprovacao')->nullable();
            $table->foreignId('coletor_id')->nullable();
            $table->foreignUuid('cupom_id')->nullable();
            $table->integer('parcelas')->nullable();
            $table->string('codigo_autorizacao', 50)->nullable();
            $table->decimal('valor_impostos', 10, 2)->nullable();
            $table->timestamp('data_ultima_modificacao')->nullable();
            $table->decimal('valor_cupom', 10, 2)->nullable();
            $table->decimal('custo_envio', 10, 2)->nullable();
            $table->decimal('valor_parcela', 10, 2)->nullable();
            $table->timestamp('data_criacao')->nullable();
            $table->string('uri_ativacao', 255)->nullable();
            $table->decimal('valor_pago_excedente', 10, 2)->nullable();
            $table->bigInteger('cartao_id')->nullable();
            $table->string('detalhe_status', 50)->nullable();
            $table->string('emissor_id', 50)->nullable();
            $table->string('metodo_pagamento_id', 50)->nullable();
            $table->string('tipo_pagamento', 50)->nullable();
            $table->integer('periodo_diferido')->nullable();
            $table->string('id_transacao_atm', 50)->nullable();
            $table->string('id_empresa_atm', 50)->nullable();
            $table->string('site_id', 10)->nullable();
            $table->foreignId('pagador_id')->nullable();
            $table->string('moeda_id', 10)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('id_ordem_transacao', 50)->nullable();

            $table->foreign('pedido_id')->references('id')->on('ml_pedidos')->onDelete('cascade');
            // $table->foreign('coletor_id')->references('id_ml')->on('ml_vendedores')->onDelete('set null');
            $table->foreign('cupom_id')->references('id')->on('ml_cupons')->onDelete('set null');
            // $table->foreign('pagador_id')->references('id_ml')->on('ml_compradores')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_pagamentos');
    }
};
