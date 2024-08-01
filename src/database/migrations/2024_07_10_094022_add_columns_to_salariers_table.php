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
            $table->date('date_exp_cin');
            $table->integer('n_assurer');
            $table->date('date_exp_rma');
            $table->string('fonction');
            $table->string('service');
            $table->integer('n_enfant_charge')->default(0);
            $table->string('phone');
            $table->string('puk')->nullable();
            $table->integer('nature_depart')->nullable();
            $table->integer('sexe');
            $table->string('categorie')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salariers', function (Blueprint $table) {
          $table->dropColumn('date_exp_cin');
          $table->dropColumn('n_assurer');
          $table->dropColumn('date_exp_rma');
          $table->dropColumn('fonction');
          $table->dropColumn('service');
          $table->dropColumn('n_enfant_charge');
          $table->dropColumn('phone');
          $table->dropColumn('puk');
          $table->dropColumn('nature_depart');
          $table->dropColumn('age');
          $table->dropColumn('anciennete');
          $table->dropColumn('sexe');
          $table->dropColumn('categorie');
        });
    }
};
