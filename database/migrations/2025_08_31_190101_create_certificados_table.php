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
        Schema::create('certificados', function (Blueprint $table) {
            $table->id();
            $table->string('foto'); 
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('inactivo');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            
            $table->foreignId('posicion_id')->constrained('posiciones')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificados');
    }
};
