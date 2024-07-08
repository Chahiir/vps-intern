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
        Schema::table('salariers', function (Blueprint $table) {
          $table->unsignedBigInteger('badge_id')->nullable();
          $table->foreign('badge_id')->references('id')->on('badges');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salariers', function (Blueprint $table) {
          $table->dropForeign(['badge_id']);
          $table->dropColumn('badge_id');
        });
    }
};
