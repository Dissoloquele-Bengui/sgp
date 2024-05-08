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
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();
            $table->string('vc_title');
            $table->text('txt_description');
            $table->string('vc_thumb');
            $table->unsignedBigInteger('it_id_seccao');
            $table->foreign('it_id_seccao')->references('id')->on('seccaos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('it_id_curso');
            $table->foreign('it_id_curso')->references('id')->on('cursos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aulas');
    }
};
