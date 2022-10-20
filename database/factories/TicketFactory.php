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

        $statuses = ['open', 'solved', 'closed', 'cancelled'];
        $priorities = ['normal', 'medium', 'high', 'urgent'];

        $randStatusIndex = array_rand($statuses);
        $randPriorityIndex = array_rand($statuses);
        $status = $statuses[$randStatusIndex];
        $priority = $priorities[$randPriorityIndex];

        return [
            'title' => fake()->sentence(2),
            'description' => fake()->sentences(3, true),
            'priority' => $priority,
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
