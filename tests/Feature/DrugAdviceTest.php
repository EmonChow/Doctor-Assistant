<?php

namespace Tests\Feature;

use App\Models\DrugAdvice;
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
            'advice' => "tesduuose",
            'status' => false
        ];
        $this->postJson('api/drug-advices', $data)
            ->assertStatus(200);
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
            'advice' => "tesddosse",
            'status' => true
        ];
        $drug_advice = DrugAdvice::first();
        $this->putJson("api/drug-advices/{$drug_advice->id}", $data)
            ->assertStatus(200);
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
        $drug_advice = DrugAdvice::first();
        $this->getJson("api/drug-advices/{$drug_advice->id}")
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
        $this->getJson("api/drug-advices")
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
        $drug_advice = DrugAdvice::first();
        $this->deleteJson("api/drug-advices/{$drug_advice->id}")
            ->assertStatus(200);
    }
}
