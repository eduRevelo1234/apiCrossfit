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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('us_cedula', 10);
            $table->string('us_nombre', 20)->nullable();
            $table->string('us_apellidos', 30)->nullable();
            $table->string('us_contraseña', 8);
            $table->string('us_estado', 10);
            $table->string('us_email', 255);
            $table->date('us_fregistro')->nullable();
            $table->string('us_telefono', 20)->nullable();
            $table->string('us_celular', 20)->nullable();
            $table->date('us_fnacimiento')->nullable();
            $table->string('us_direccion', 255)->nullable();
            $table->string('us_sexo', 10);
            $table->unsignedBigInteger('us_rl_codigo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
