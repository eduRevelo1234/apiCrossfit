<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pl_nombre', 255)->nullable();
            $table->integer('pl_numero_clase')->nullable();
            $table->string('pl_estado', 10);
            $table->decimal('pl_costo_inscripcion', 5, 2)->nullable();
            $table->decimal('pl_costo_mensual', 5, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
