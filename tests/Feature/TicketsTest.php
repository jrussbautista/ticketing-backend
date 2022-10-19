<?php

namespace Tests\Feature;

use App\Models\Priority;
use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TicketsTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_owned_tickets() {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        Ticket::factory()->create();
        $myTicket = Ticket::factory(['user_id' => $user->id])->create();

        $response = $this->getJson('/api/tickets?created_by_me=true');

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('data', 1)
                ->has('links')
                ->has('meta')
                ->has('data.0', fn ($json) =>
                    $json->where('id', $myTicket->id)
                        ->where('title', $myTicket->title)
                        ->etc()
            ));
    }
}
