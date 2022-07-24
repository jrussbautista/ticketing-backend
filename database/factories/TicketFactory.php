<?php

namespace Database\Factories;

use App\Models\Priority;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'title' => fake()->sentence(2),
            'description' => fake()->sentences(3, true),
            'priority_id' => Priority::inRandomOrder()->first()->id,
            'type_id' => TicketType::inRandomOrder()->first()->id,
            'status_id' => Status::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'assignee_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
