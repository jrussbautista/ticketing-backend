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
        'name'
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
}
