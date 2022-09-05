<?php

namespace Tests\Feature;

use App\Models\DrugTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
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
        $drug_type = DrugTypes::first();
        $this->putjson("api/drug-type/{$drug_type->id}", $data)
            ->assertStatus(200);
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

        $drug_type = DrugTypes::first();
        $this->getjson("api/drug-type/{$drug_type->id}")
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

        $this->getJson('api/drug-type')
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
        $drug_type = DrugTypes::first();
        $this->deleteJson("api/drug-type/{$drug_type->id}")
            ->assertStatus(200);
    }
}
