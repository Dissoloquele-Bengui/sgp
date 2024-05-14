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
        Schema::create('campo_pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('valor');
            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_campo');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campo_pedidos');
    }
};
