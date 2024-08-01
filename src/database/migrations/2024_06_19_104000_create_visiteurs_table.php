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
        Schema::create('visiteurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('cin');
            $table->string('entreprise');
            $table->string('motif');
            $table->dateTime('entrer');
            $table->dateTime('sortie')->nullable();
            $table->unsignedBigInteger('badge_id')->nullable();
            $table->timestamps();

            $table->foreign('badge_id')->references('id')->on('badges')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visiteurs');
    }
};
