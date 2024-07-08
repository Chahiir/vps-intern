<?php

namespace Database\Factories;

use App\Models\Badge;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Badge>
 */
class BadgeFactory extends Factory
{
    protected $model = Badge::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference' => strtoupper($this->faker->bothify('??-###')),
            'taken' => false, // Set taken to false by default
            'type_id' => $this->faker->randomElement([1, 3, 6, 7]),
        ];
    }
}
