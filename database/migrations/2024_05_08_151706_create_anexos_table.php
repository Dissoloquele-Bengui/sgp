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
        Schema::create('anexos', function (Blueprint $table) {
            $table->id();
            $table->string('vc_title');
            $table->text('txt_description');
            $table->text('vc_file');
            $table->string('vc_thumb')->nullable();
            $table->time('tm_duraction');
            $table->unsignedBigInteger('it_id_aula');
            $table->foreign('it_id_aula')->references('id')->on('aulas')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('it_id_categoriaAnexo');
            $table->foreign('it_id_categoriaAnexo')->references('id')->on('categoria_anexos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anexos');
    }
};
