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
        Schema::table('users', function (Blueprint $table) {
<<<<<<< HEAD
            //$table->string('vc_pnome');
            //$table->string('vc_nome_meio')->nullable();
            //$table->string('vc_unome');
            //$table->boolean('ativo')->nullable()->default(true);
=======
           /* $table->string('vc_pnome');
            $table->string('vc_nome_meio')->nullable();
            $table->string('vc_unome');
            $table->boolean('ativo')->nullable()->default(true); */
>>>>>>> 126a8e652cc1e82a573677901687c1b0cc57804c
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            /* $table->dropColumn('vc_pnome');
            $table->dropColumn('vc_nome_meio');
            $table->dropColumn('vc_unome');
            $table->dropColumn('ativo'); */
        });
    }
};
