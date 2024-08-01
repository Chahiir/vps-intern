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
        Schema::create('contact_urgences', function (Blueprint $table) {
            $table->id();
            $table->string('nom_contact');
            $table->string('phone_contact');
            $table->string('lien_familiale');
            $table->unsignedBigInteger('salarier_id');

            $table->foreign('salarier_id')->references('id')->on('salariers')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_urgences');
    }
};
