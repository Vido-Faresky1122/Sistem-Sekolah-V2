<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SchoolClass>
 */
class SchoolClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = SchoolClass::class;
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['10 AKL', '11 AKL', '12 AKL', '10 BiD 1', '10 BiD 2', '12 TKJ 1', '12 TKJ 2', '12 TKJ 3']),
        ];
    }
}
