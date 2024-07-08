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
        Schema::create('salariers', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('cin');
            $table->string('adresse');
            $table->string('cnss')->nullable();
            $table->string('situation_familiale');
            $table->date('date_naissance');
            $table->unsignedBigInteger('contrat_type');
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->timestamps();

            $table->foreign('contrat_type')->references('id')->on('contrat_types');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salariers');
    }
};
