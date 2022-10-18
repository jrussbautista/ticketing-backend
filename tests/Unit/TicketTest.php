<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
{
    use RefreshDatabase; 

    public function test_has_tickets()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->tickets);
    }
}
