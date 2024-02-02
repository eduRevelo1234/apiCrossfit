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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pg_nombre', 10);
            $table->string('pg_tipo', 10);
            $table->date('pg_fecha')->nullable();
            $table->string('pg_resplado', 255)->nullable();
            $table->decimal('pg_monto', 5, 2)->nullable();
            $table->unsignedBigInteger('pg_sc_codigo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
