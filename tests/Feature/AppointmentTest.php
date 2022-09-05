<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\Appointment;

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
            "doctor_id" =>2,
            "patient_id" =>2,
            "appointment_date" => "2022/2/1",
            "schedule_day_time_id" =>8
        ];

        $this->postJson('api/apppoinment', $data)
            ->assertStatus(200);

        
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
            "appointment_date" => "2022/2/6",
            "schedule_day_time_id" =>6
        ];
        $appointment = Appointment::first();
        $this->putJson("api/appointment/{$appointment->id}", $data)
            ->assertStatus(200);
        
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

        $appointment = Appointment::first();
        $this->getJson("api/appointment/{$appointment->id}")
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

        $this->getJson('api/appointment')
        ->assertStatus(200);
    }
    /**
     * test delete appointment.
     *
     * @return void
     */

    public function test_delete_appointment()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $appointment = Appointment::first();
        $this->deleteJson("api/appointment/{$appointment->id}")
            ->assertStatus(200);
    }
}
