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
        Schema::create('ensal', function (Blueprint $table) {
            $table->id();
            $table->string('fecha')->default(now());
            $table->string('producto');
            $table->integer('cantidad')->default(1);
            $table->string('concepto')->default('Salida de producto - Venta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ensal');
    }
};
