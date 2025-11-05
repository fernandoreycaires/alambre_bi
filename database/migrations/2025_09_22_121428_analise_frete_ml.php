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
        Schema::create('analise_frete_ml', function (Blueprint $table) {
            $table->uuid("id")->unique();
            $table->date('data');
            $table->string('pedidoid');
            $table->string('sku')->nullable();
            $table->string('anuncio');
            $table->float('preco_venda', 8, 2)->nullable();
            $table->float('frete_pago_cliente', 8, 2)->nullable();
            $table->float('frete_subsidiado', 8, 2)->nullable();
            $table->integer('comissao_porcentagem');
            $table->float('comissao_valor', 8, 2)->nullable();
            $table->float('custo_produto', 8, 2)->nullable();
            $table->float('outras_despesas', 8, 2)->nullable();
            $table->float('receita_liquida', 8, 2)->nullable();
            $table->float('lucro', 8, 2)->nullable();
            $table->float('margem_porcentagem', 8, 2)->nullable();
            $table->float('frete_vs_preco', 8, 2)->nullable();
            $table->integer('alerta_margem');
            $table->integer('alerta_frete');
            $table->string('uf_destino')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analise_frete_ml');
        
    }
};
