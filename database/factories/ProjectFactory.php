<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Task;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'description' =>  $this->faker->paragraph(1),
            'deadline' => $this->faker->dateTimeBetween('-1 week', '+3 week'),
            'user_id' => User::inRandomOrder()->first()->id,
            'status' => Arr::random(Task::STATUS),
            'client_id' => client::inRandomOrder()->first()->id,
        ];
    }
}
