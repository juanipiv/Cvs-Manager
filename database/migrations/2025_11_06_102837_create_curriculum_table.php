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
        Schema::create('curriculum', function (Blueprint $table) {
            $table->id();    
            $table->string('nombre', 20);
            $table->string('apellidos', 60);
            $table->string('telefono', 20)->unique();
            $table->string('email')->unique();
            $table->date('fecha_nacimiento');
            $table->decimal('nota_media', 3, 1);
            $table->longText('experiencia');
            $table->longText('formacion');
            $table->longText('habilidades');
            $table->string('path', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum');
    }
};
