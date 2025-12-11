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
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->string('product')->unique();
            $table->integer('qty');
            $table->integer('CONTADO');
            $table->integer('precio1');
            $table->integer('precio2');
            $table->integer('precio3');
            $table->integer('precio4');
            $table->integer('precio5');
            $table->integer('precio6');
            $table->integer('precio7');
            $table->integer('precio8');
            $table->integer('precio9');
            $table->integer('precio10');
            $table->integer('precio11');
            $table->integer('precio12');
            $table->integer('semanal1');
            $table->integer('semanal2');
            $table->integer('semanal3');
            $table->integer('semanal4');
            $table->integer('semanal5');
            $table->integer('semanal6');
            $table->integer('semanal7');
            $table->integer('semanal8');
            $table->integer('semanal9');
            $table->integer('semanal10');
            $table->integer('semanal11');
            $table->integer('semanal12');
            $table->string('categoria');
            $table->integer('anoPrecio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
