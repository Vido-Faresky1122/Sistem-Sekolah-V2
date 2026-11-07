<?php

namespace Database\Factories;

use App\Models\Major;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Major>
 */
class MajorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Major::class;
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['AKL', 'BiD', 'TKJ']),
        ];
    }
}
