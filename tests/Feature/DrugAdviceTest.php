<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DrugAdviceTest extends TestCase
{
     /**
     * A basic feature test create drug advice.
     *
     * @return void
     */
    public function test_create_drug_advice()
    {
       
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);


        $data = [
                'advice' => "tesdose",
                'status' => false
        ];

        $this->postJson('api/drug-advices', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('drug_advice', $data);
    }

    /**
     * test update dose.
     *
     * @return void
     */
    public function test_update_drug_advice()
    {
        
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $data = [
            'advice' => "tesddose",
            'status' => true
    ];

        $this->json('PUT', 'api/drug-advices/1', $data)
            ->assertStatus(200);
        $this->assertDatabaseHas('drug_advice', $data);
    }

    /**
     * test get drug advice.
     *
     * @return void
     */
    public function test_get_a_drug_advice()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/drug-advices/1')
            ->assertStatus(200);
    }

    /**
     * test get all drug advices.
     *
     * @return void
     */
    public function test_get_all_drug_advice()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/drug-advices')
            ->assertStatus(200);
    }
    /**
     * test delete drug advices.
     *
     * @return void
     */

    public function test_delete_drug_advice()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('DELETE', 'api/drug-advices/1')
            ->assertStatus(200);
    }
}
