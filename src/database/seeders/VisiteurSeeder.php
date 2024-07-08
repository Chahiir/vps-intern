<?php

namespace Database\Seeders;

use App\Models\Visiteur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisiteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Visiteur::factory()->count(100)->create();
    }
}
