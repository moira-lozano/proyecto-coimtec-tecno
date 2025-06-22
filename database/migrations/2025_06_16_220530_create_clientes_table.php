<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // ahora es la clave primaria
            $table->string('carnet')->unique(); // solo un campo más, pero único
            $table->string('nombre');
            $table->string('nit')->nullable();
            $table->string('correo')->unique()->nullable();
            $table->boolean('empresa')->default(false);
            $table->string('cod_pais1')->nullable();
            $table->string('celular1')->nullable();
            $table->string('cod_pais2')->nullable();
            $table->string('celular2')->nullable();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
