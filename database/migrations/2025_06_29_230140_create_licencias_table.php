c<?php

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
        Schema::create('licencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo')->unique();
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_mayorista', 10, 2)->nullable();
            $table->decimal('precio_renovacion', 10, 2)->nullable();
            $table->boolean('trasladable')->default(false);
            $table->boolean('deducible')->default(false);
            $table->boolean('formateable')->default(false);
            $table->boolean('compra_asistida')->default(false);
            $table->boolean('compartida')->default(false);

            // Llaves foráneas
            $table->foreignId('marca_id')->constrained('marcas')->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licencias');
    }
};
