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
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('tamanho');
            $table->string('tipo_arquivo');
            $table->unsignedBigInteger('id_topico');
            $table->foreign('id_topico')->references('id')->on('topicos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquivos');
    }
};
