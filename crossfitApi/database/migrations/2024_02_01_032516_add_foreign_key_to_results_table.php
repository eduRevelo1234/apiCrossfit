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
        Schema::table('results', function (Blueprint $table) {
            $table->foreign('rl_us_codigo')->references('id')->on('users');
            $table->foreign('rl_ej_codigo')->references('id')->on('exercises');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropForeign(['rl_ej_codigo']);
            $table->dropForeign(['rl_us_codigo']);
        });
    }
};
