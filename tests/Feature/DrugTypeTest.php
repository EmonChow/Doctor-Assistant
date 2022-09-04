<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DrugTypeTest extends TestCase
{
      /**
     * A basic feature test create drug type.
     *
     * @return void
     */
    public function test_create_drug_type()
    {
       
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);


        $data = [
                'type' => "teeses",
                'status' => false
        ];

        $this->postJson('api/drug-type', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('drug_types', $data);
    }

    /**
     * test update drug type.
     *
     * @return void
     */
    public function test_update_drug_type()
    {
        
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $data = [
            'type' => "tesdose",
            'status' => true
    ];

        $this->json('PUT', 'api/drug-type/3', $data)
            ->assertStatus(200);
        $this->assertDatabaseHas('drug_types', $data);
    }

    /**
     * test get drug type.
     *
     * @return void
     */
    public function test_get_a_drug_type()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/drug-type/3')
            ->assertStatus(200);
    }

    /**
     * test get all drug type.
     *
     * @return void
     */
    public function test_get_all_drug_type()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/drug-type')
            ->assertStatus(200);
    }
    /**
     * test delete drug type.
     *
     * @return void
     */

    public function test_delete_drug_type()
    {
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('DELETE', 'api/drug-type/3')
            ->assertStatus(200);
    }
}
