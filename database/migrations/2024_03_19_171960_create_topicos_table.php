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
        Schema::create('topicos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero')->nullable();
            $table->string('topico');
            $table->string('capa')->nullable();
            $table->longText('descricao')->nullable();
            $table->unsignedBigInteger('id_curso');
            $table->foreign('id_curso')->references('id')->on('cursos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topicos');
    }
};
