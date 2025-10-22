<?php

namespace Database\Factories;

use App\Models\Farm;
use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plant>
 */
class PlantFactory extends Factory
{
    protected $model = Plant::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' ' . $this->faker->word(),
            'plant_code' => 'PL' . Str::upper(Str::random(6)),
            'planted_at' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'insertion_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'batch' => (string) $this->faker->numberBetween(1, 10),
            'images' => [],
            'notes' => $this->faker->sentence(),
            'farm_id' => Farm::factory(),
        ];
    }
}
