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
        Schema::table('notificacaos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pedido')->nullable();
            $table->foreign('id_pedido')
                ->references('id')
                ->on('pedidos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notificacaos', function (Blueprint $table) {
            //
        });
    }
};
