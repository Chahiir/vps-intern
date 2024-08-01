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
        Schema::table('partenaire_visites', function (Blueprint $table) {
          $table->unsignedBigInteger('partenaire_id');
          $table->foreign('partenaire_id')->references('id')->on('partenaires')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partenaire_visites', function (Blueprint $table) {
          $table->dropForeign(['partenaire_id']);
          $table->dropColumn('partenaire_id');
        });
    }
};
