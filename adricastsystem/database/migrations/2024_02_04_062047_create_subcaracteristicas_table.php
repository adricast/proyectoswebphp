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
        Schema::create('subcaracteristicas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('caracteristica_id')->constrained('caracteristicas');
            $table->string('descripcion');
            $table->boolean('estado')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcaracteristicas');
    }
};
