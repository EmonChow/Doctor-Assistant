<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\ScheduleDayTime;

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
            "doctor_id" =>34,
            "patient_id" =>41,
            "appointment_date" =>"2022/2/1",
            "schedule_day_time_id" =>539
        ];

        $this->postJson('api/apppoinment',$data)
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
            "doctor_id" => 23,
            "patient_id" =>17,
            "appointment_date" => "2022/2/6",
            "schedule_day_time_id" => 327
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

        $this->getJson('api/appointment')->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->hasAll([
            'data', 'current_page', 'first_page_url', 'from', 'last_page', 'last_page_url',
            'links', 'next_page_url', 'path', 'per_page', 'prev_page_url', 'to', 'total'
        ])->whereAllType([
            'data.id' => ['string', 'integer'],
            'data.doctor_id' => ['string', 'integer'],
            'data.appointment_date' => ['string', 'integer'],
            'data.schedule_day_time_id' => ['string', 'integer'],
        ]));
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
