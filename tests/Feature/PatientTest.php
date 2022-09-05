<?php

namespace Tests\Feature;

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
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
        $patient = Patient::first();
        $this->putJson("api/patient/{$patient->id}", $data)
            ->assertStatus(200);
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

        $patient = Patient::first();
        $this->getJson("api/patient/{$patient->id}")
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

        $this->getJson('api/patient')
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
        $patient = Patient::first();
        $this->deleteJson("api/patient/{$patient->id}")
            ->assertStatus(200);
    }
}
