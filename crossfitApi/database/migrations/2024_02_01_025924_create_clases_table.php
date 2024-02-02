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
        Schema::create('clases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cl_nombre', 255)->nullable();
            $table->date('cl_fecha')->nullable();
            $table->time('cl_hora')->nullable();
            $table->integer('cl_maximo')->nullable();
            $table->integer('cl_actual')->nullable();
            $table->unsignedBigInteger('cl_rt_code');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clases');
    }
};
