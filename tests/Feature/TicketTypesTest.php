<?php

namespace Tests\Feature;

use App\Models\TicketType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTypes extends TestCase
{
    use RefreshDatabase;

    private const JSON_TICKET_TYPES = [
        'id',
        'name',
        'status'
    ];

    private const JSON_TICKET_TYPES_COLLECTION = [
        'data' => [
            '*' => self::JSON_TICKET_TYPES,
        ],
        'links' => [
            'first',
            'last',
            'prev',
            'next',
        ],
        'meta' => [
            'current_page',
            'from',
            'path',
            'per_page',
            'to',
        ],
    ];

    public function test_authenticated_user_gets_ticket_types()
    {   
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        
        TicketType::factory()->create();

        $response = $this->getJson('/api/types');
        $response->assertStatus(200);
        $response->assertJsonStructure(self::JSON_TICKET_TYPES_COLLECTION);
    }

    public function test_admin_can_deactivate_ticket_type_status() {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->actingAs($user);

        $ticketType =  TicketType::factory()->create(['status' => TicketType::STATUS_ACTIVE]);

        $response = $this->postJson('/api/types/' . $ticketType->id . '/deactivate');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'status' => TicketType::STATUS_INACTIVE
            ]
        ]);
    }

    public function test_non_admin_cannot_deactivate_ticket_type_status() {
        $user = User::factory()->create(['role' => User::ROLE_USER]);
        $this->actingAs($user);

        $ticketType =  TicketType::factory()->create(['status' => TicketType::STATUS_ACTIVE]);

        $response = $this->postJson('/api/types/' . $ticketType->id . '/deactivate');
        $response->assertStatus(403);
    }

    public function test_admin_can_activate_ticket_type_status() {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->actingAs($user);

        $ticketType =  TicketType::factory()->create(['status' => TicketType::STATUS_INACTIVE]);

        $response = $this->postJson('/api/types/' . $ticketType->id . '/activate');
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'status' => TicketType::STATUS_ACTIVE
            ]
        ]);
    }

    public function test_non_admin_cannot_activate_ticket_type_status() {
        $user = User::factory()->create(['role' => User::ROLE_USER]);
        $this->actingAs($user);

        $ticketType =  TicketType::factory()->create(['status' => TicketType::STATUS_INACTIVE]);

        $response = $this->postJson('/api/types/' . $ticketType->id . '/activate');
        $response->assertStatus(403);
    }
}
