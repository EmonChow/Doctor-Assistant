<?php

namespace Tests\Feature;

use App\Models\DrugStrength;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DrugStrengthTest extends TestCase
{
      /**
     * A basic feature test create drug strength.
     *
     * @return void
     */
    public function test_create_drug_strength()
    {
       
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $data = [
                'strength' => "teettsde",
                'status' => false
        ];
        $this->postJson('api/drug-strength', $data)
            ->assertStatus(200);
       
    }

    /**
     * test update drug strength.
     *
     * @return void
     */
    public function test_update_drug_strength()
    {
        
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $data = [
            'strength' => "tesddose",
            'status' => true
    ];
        $drug_strength = DrugStrength::first();
        $this->putJson("api/drug-strength/{$drug_strength->id}", $data)
            ->assertStatus(200);
    }

    /**
     * test get drug strength.
     *
     * @return void
     */
    public function test_get_a_drug_strength()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $drug_strength = DrugStrength::first();
        $this->getJson("api/drug-strength/{$drug_strength->id}")
            ->assertStatus(200);
    }

    /**
     * test get all drug strength.
     *
     * @return void
     */
    public function test_get_all_drug_strength()
    {
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $this->json('GET', 'api/drug-strength')
            ->assertStatus(200);
    }
    /**
     * test delete drug advices.
     *
     * @return void
     */

    public function test_delete_drug_strength()
    {
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $drug_strength = DrugStrength::first();
        $this->deleteJson("api/drug-strength/{$drug_strength->id}")
            ->assertStatus(200);
    }
}
