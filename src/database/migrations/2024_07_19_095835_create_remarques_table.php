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
        Schema::create('remarques', function (Blueprint $table) {
            $table->id();
            $table->integer('annee')->default(date('Y'));
            $table->unsignedBigInteger('salarie_id');
            $table->string('point_fort')->nullable();
            $table->string('point_ameliorer')->nullable();
            $table->string('projet')->nullable();
            $table->string('action')->nullable();
            $table->string('commentaire')->nullable();
            $table->timestamps();

            $table->foreign('salarie_id')->references('id')->on('salariers');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remarques');
    }
};
