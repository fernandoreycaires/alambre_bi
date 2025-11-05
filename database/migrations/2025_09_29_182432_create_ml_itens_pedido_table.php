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
        Schema::create('ml_itens_pedido', function (Blueprint $table) {
            $table->uuid('id');
            $table->bigInteger('id_ml')->nullable();
            $table->foreignUuid('pedido_id');
            $table->string('item_id', 50)->nullable();
            $table->string('titulo', 255)->nullable();
            $table->string('categoria_id', 50)->nullable();
            $table->bigInteger('variacao_id')->nullable();
            $table->string('campo_personalizado_vendedor', 255)->nullable();
            $table->decimal('preco_global', 10, 2)->nullable();
            $table->decimal('peso_liquido', 10, 2)->nullable();
            $table->text('garantia')->nullable();
            $table->string('condicao', 50)->nullable();
            $table->string('sku_vendedor', 50)->nullable();
            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);
            $table->decimal('preco_unitario_completo', 10, 2)->nullable();
            $table->string('moeda_id', 10)->nullable();
            $table->integer('dias_fabricacao')->nullable();
            $table->integer('quantidade_selecionada')->nullable();
            $table->integer('quantidade_solicitada_valor')->nullable();
            $table->string('quantidade_solicitada_medida', 50)->nullable();
            $table->decimal('taxa_venda', 10, 2)->nullable();
            $table->string('tipo_listagem_id', 50)->nullable();
            $table->decimal('taxa_cambio_base', 10, 2)->nullable();
            $table->string('moeda_base_id', 10)->nullable();
            $table->integer('elemento_id')->nullable();

            $table->foreign('pedido_id')->references('id')->on('ml_pedidos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ml_itens_pedido');
    }
};
