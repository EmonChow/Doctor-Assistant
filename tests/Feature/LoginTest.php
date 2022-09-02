<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->postJson('/api/login', ['email' => 'admin@gmail.com', 'password' => 'password']);

        $response->assertStatus(422);

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);

        $response->assertStatus(200);

        $token = $response->getContent();

        $change_email = $this->postJson('/api/change-email', ['email' => 'admin@example.com', 'password' => 'password']);

        $change_email->assertStatus(200);

        // Change Password

        // Create New Role

    }
}
