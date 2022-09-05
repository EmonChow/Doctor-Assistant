<?php

namespace Tests\Feature;

use App\Http\Controllers\DrugController;
use App\Models\Drug;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
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
            'trade_name' => "nsswwwwwid",
            'generic_name' => "notssedd",
            'additional_advice' => "test traddde",
            'warning' => "tssssscc",
            'side_effect' => "testssed"
        ];
        $this->postJson('api/drugs', $data)
            ->assertStatus(200);

        
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
            'trade_name' =>"traedname",
            'generic_name' =>"notsse",
            'additional_advice' =>"testtrade",
            'warning' =>"testtradedds",
            'side_effect' =>"tesradedd"
        ];
        $drug = Drug::first();
        $this->putJson("api/drugs/{$drug->id}", $data)
            ->assertStatus(200);
       
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

        $drug = Drug::first();
        $this->getJson("api/drugs/{$drug->id}")
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

        $this->getJson('api/drugs')
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
          $drug = Drug::first();
        $this->deleteJson("api/drugs/{$drug->id}")
            ->assertStatus(200);
    }
}
