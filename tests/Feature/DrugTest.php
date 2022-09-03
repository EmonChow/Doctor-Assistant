<?php

namespace Tests\Feature;

use App\Http\Controllers\DrugController;
use App\Models\Drug;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DrugTest extends TestCase
{
    /**
     * A basic feature test create drug.
     *
     * @return void
     */
    public function test_create_drug()
    {
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);


        $data = [
            'trade_name' => 'nameddw',
            'generic_name' => 'notssedd',
            'additional_advice' => "test traddde",
            'warning' => 'tssssscc',
            'side_effect' => 'testsssssded'
        ];
        $this->postJson('api/drugs', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('drugs', $data);
    }

    /**
     * test update drug.
     *
     * @return void
     */
    public function test_update_drug()
    {
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $data = [
            'trade_name' => 'tradsss_name',
            'generic_name' => 'notsse',
            'additional_advice' => "test trade 6",
            'warning' => 'test trade 6',
            'side_effect' => 'test trade 6'
        ];

        $this->json('PUT', 'api/drugs/1', $data)
            ->assertStatus(200);
        $this->assertDatabaseHas('drugs', $data);
    }

    /**
     * test get drug.
     *
     * @return void
     */
    public function test_get_a_drug()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/drugs/1')
            ->assertStatus(200);
    }

    /**
     * test get all drug.
     *
     * @return void
     */
    public function test_get_all_drug()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/drugs')
            ->assertStatus(200);
    }
    /**
     * test delete drug.
     *
     * @return void
     */

    public function test_delete_drug()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('DELETE', 'api/drugs/1')
            ->assertStatus(200);
    }
}
