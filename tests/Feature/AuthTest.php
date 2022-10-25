<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    use RefreshDatabase;

    public function test_authenticated_user_should_retrieve_its_details()
    {   
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson('/api/me');

        $response->assertStatus(200);
        $response->assertExactJson([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at,
                'role' => $user->role
            ]
        ]);
    }


}
