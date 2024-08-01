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
        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('name');
          $table->unsignedBigInteger('salarier_id');

          $table->foreign('salarier_id')->references('id')->on('salariers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
          $table->dropForeign(['salarier_id']);
          $table->dropColumn('salarier_id');
          $table->string('name');
        });
    }
};
