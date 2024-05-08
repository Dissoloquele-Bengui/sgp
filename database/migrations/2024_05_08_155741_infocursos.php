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
        Schema::create('infocursos', function(Blueprint $table){
            $table->id();
            $table->text('txt_text');
            $table->unsignedBigInteger('it_id_curso');
            $table->unsignedBigInteger('it_id_categoriaInfo');
            $table->foreign('it_id_curso')->references('id')->on('cursos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('it_id_categoriaInfo')->references('id')->on('categoria_infos')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infocursos');
    }
};
