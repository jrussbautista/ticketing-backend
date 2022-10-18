<?php

namespace Database\Factories;

use App\Models\Priority;
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

        $statuses = ['pending','resolved', 'closed', 'rejected'];

        $randIndex = array_rand($statuses);
        $status = $statuses[$randIndex];

        return [
            'title' => fake()->sentence(2),
            'description' => fake()->sentences(3, true),
            'priority_id' => function() {
                return Priority::factory()->create()->id;
            },
            'type_id' => function() {
                return TicketType::factory()->create()->id;
            },
            'status' => $status,
            'user_id' => function() {
                return User::factory()->create()->id;
            },
            'assignee_id' => function() {
                return User::factory()->create()->id;
            },
        ];
    }
}
