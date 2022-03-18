<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\Auditor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Agenda>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText(50),
            'auditor' => Auditor::inRandomOrder()->limit(1)->first(),
        ];
    }
}
