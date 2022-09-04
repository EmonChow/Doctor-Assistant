<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatientTest extends TestCase
{
       /**
     * A basic feature test create patient.
     *
     * @return void
     */
    public function test_create_patient()
    {
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $data = [
            "height" => 7,
            "weight" => 56,
            "birth_date" => "2022/2/1"
        ];

        $this->postJson('api/patient', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('patients', $data);
    }

    /**
     * test update patient.
     *
     * @return void
     */
    public function test_update_patient()
    {
        
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $data = [
            "height" => 6,
            "weight" => 56,
            "birth_date" => "2022/2/1"
        ];

        $this->json('PUT', 'api/patient/3', $data)
            ->assertStatus(200);
        $this->assertDatabaseHas('patients', $data);
    }

    /**
     * test get patient.
     *
     * @return void
     */
    public function test_get_a_patient()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/patient/3')
            ->assertStatus(200);
    }

    /**
     * test get all patients.
     *
     * @return void
     */
    public function test_get_all_patient()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/patient')
            ->assertStatus(200);
    }
    /**
     * test delete patient.
     *
     * @return void
     */

    public function test_delete_patient()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('DELETE', 'api/patient/3')
            ->assertStatus(200);
    }
}
