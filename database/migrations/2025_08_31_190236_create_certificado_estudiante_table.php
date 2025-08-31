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
        Schema::create('certificado_estudiante', function (Blueprint $table) {
            $table->id();
            $table->foreignId('certificado_id')->constrained('certificados')->cascadeOnDelete();
            $table->foreignId('estudiante_id')->constrained('estudiantes')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificado_estudiante');
    }
};
