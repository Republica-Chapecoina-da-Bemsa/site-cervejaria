<?php

namespace Database\Factories;

use Ramsey\Uuid\Uuid;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'id' => (string) Uuid::uuid4(),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'location' => $this->faker->address(),
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
