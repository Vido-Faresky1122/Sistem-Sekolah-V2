<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Subject::class;
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['Pemograman Web Lanjutan', 'Pemograman Web Dasar', 'Pemograman Lanjut']),
        ];
    }
}
