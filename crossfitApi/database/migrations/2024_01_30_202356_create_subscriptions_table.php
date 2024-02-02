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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('sc_finicio');
            $table->date('sc_ffin');
            $table->string('sc_estado', 10);
            $table->string('sc_observacion', 255)->nullable();
            $table->string('sc_periodo', 10);
            $table->unsignedBigInteger('sc_us_codigo');
            $table->unsignedBigInteger('sc_pl_codigo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
