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
        Schema::create('seccaos', function (Blueprint $table) {
            $table->id();
            $table->string('it_number');
            $table->string('vc_title');
            $table->text('txt_description');

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
        Schema::dropIfExists('seccaos');
    }
};
