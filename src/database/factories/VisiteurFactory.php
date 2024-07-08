<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visiteur>
 */
class VisiteurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'cin' => $this->faker->unique()->numerify('??######'),
            'entreprise' => $this->faker->company,
            'motif' => $this->faker->sentence,
            'entrer' => $this->faker->dateTimeThisYear,
            'sortie' => $this->faker->optional()->dateTimeThisYear,
            'badge_id' => \App\Models\Badge::factory(),
        ];
    }
}
