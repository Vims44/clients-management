<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Client;

class ClientApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_client_successfully()
    {
        $payload = [
            'name' => 'Иван Иванов',
            'email' => 'ivan@example.com',
            'phone' => '+79001234567',
        ];

        $response = $this->postJson('/api/clients', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'name' => 'Иван Иванов',
                     'email' => 'ivan@example.com',
                     'phone' => '+79001234567',
                 ]);

        $this->assertDatabaseHas('clients', $payload);
    }
}
