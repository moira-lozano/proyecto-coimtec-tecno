<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
           // $table->dropColumn('rol');
        });
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            //$table->enum('rol', ['administrador', 'vendedor', 'cliente', 'cliente - canal'])->nullable();
        });
    }

};
