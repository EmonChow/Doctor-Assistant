<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
           /**
     * A basic feature test create apppoinment.
     *
     * @return void
     */
    public function test_create_apppoinment()
    {
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $data = [
            "doctor_id" => 3,
            "patient_id" => 3,
            "appointment_date" => "2022/2/1",
            "schedule_day_time_id" => 3
        ];

        $this->postJson('api/apppoinment', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('apppoinments', $data);
    }

    /**
     * test update apppoinment.
     *
     * @return void
     */
    public function test_update_apppoinment()
    {
        
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $data = [
            "doctor_id" => 2,
            "patient_id" => 2,
            "appointment_date" => "2022/2/1",
            "schedule_day_time_id" => 2
        ];

        $this->json('PUT', 'api/appointment/3', $data)
            ->assertStatus(200);
        $this->assertDatabaseHas('appointments', $data);
    }

    /**
     * test get appointment.
     *
     * @return void
     */
    public function test_get_a_appointment()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/appointment/3')
            ->assertStatus(200);
    }

    /**
     * test get all appointment.
     *
     * @return void
     */
    public function test_get_all_appointment()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/appointment')
            ->assertStatus(200);
    }
    /**
     * test delete appointment.
     *
     * @return void
     */

    public function test_delete_appointment()
    {

        // $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        // $response->assertStatus(200);

        // $this->json('DELETE', 'api/appointment/3')
        //     ->assertStatus(200);
    }
}
