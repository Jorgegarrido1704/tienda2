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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('fecha');
            $table->string('semanal');
            $table->integer('meses');
            $table->string('ruta');
            $table->string('cuenta')->unique();
            $table->string('cliente');
            $table->string('aval')->nullable();
            $table->string('domcli');
            $table->string('espo')->nullable();
            $table->string('domaval');
            $table->string('col')->nullable();
            $table->string('ref2')->nullable();
            $table->string('domre2')->nullable();
            $table->string('promotor');
            $table->string('ref1')->nullable();
            $table->string('vendedor');
            $table->string('cobrador');
            $table->string('domref1')->nullable();
            $table->string('entrego')->nullable();
            $table->integer('cantArt');
            $table->string('articulo');
            $table->integer('precio');
            $table->integer('enganche');
            $table->integer('saldo');
            $table->string('estatus')->default('Activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
