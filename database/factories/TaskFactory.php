<?php

namespace Database\Factories;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class TaskFactory extends Factory
{
    use WithFaker;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->sentence,
            'due_date' => now()->addMonth()->format('Y-m-d'),
            'status' => TaskStatusEnum::PENDING,
        ];
    }
}
