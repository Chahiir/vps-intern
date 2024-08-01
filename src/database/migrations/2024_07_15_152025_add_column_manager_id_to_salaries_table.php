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
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->boolean('is_manager')->default(false);

            $table->foreign('manager_id')->references('id')->on('salariers')->onDelete('set null')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salariers', function (Blueprint $table) {
          $table->dropForeign(['manager_id']);
          $table->dropColumn('manager_id');
          $table->dropColumn('is_manager');
        });
    }
};
