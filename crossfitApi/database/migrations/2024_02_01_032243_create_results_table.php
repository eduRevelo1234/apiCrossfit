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
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('rl_fecha');
            $table->string('rl_observacion', 255);
            $table->integer('rl_rondas');
            $table->integer('rl_repeticion');
            $table->integer('rl_peso');
            $table->string('rl_unidad', 255);
            $table->unsignedBigInteger('rl_us_codigo')->nullable();
            $table->unsignedBigInteger('rl_ej_codigo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
