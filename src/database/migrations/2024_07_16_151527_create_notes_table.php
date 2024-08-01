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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manager_id');
            $table->unsignedBigInteger('salarie_id');
            $table->unsignedBigInteger('note_sub_categorie_id');
            $table->integer('note');
            $table->string('remarque')->nullable();
            $table->integer('annee')->default(date('Y'));
            $table->timestamps();

            $table->foreign('manager_id')->references('id')->on('salariers');
            $table->foreign('salarie_id')->references('id')->on('salariers');
            $table->foreign('note_sub_categorie_id')->references('id')->on('note_sub_categories');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
