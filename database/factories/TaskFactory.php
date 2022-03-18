<?php

namespace Database\Factories;

use App\Models\Agenda;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $start_date = $this->faker->dateTimeBetween('now', '+30 days');
        $end_date = $this->faker->dateTimeBetween($start_date, '+30 days');
        return [
            'name' => $this->faker->name(),
            'agenda' => Agenda::inRandomOrder()->limit(1)->first(),
            'review' => $this->faker->realTextBetween(200, 400),
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
    }
}
