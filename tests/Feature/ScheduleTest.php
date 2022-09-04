<?php

namespace Tests\Feature;

use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    /**
     * A basic feature test create schedule.
     *
     * @return void
     */
    public function test_create_schedule()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);


        $data = array(
            "title" => "Emonff",
            "address" => "test address d",
            "contact_person" => "test dcontact",
            "phone" => "015382141",
            "email" => "emo3n011e@gmail.com",
            "days" => [
                [
                    "day" => "Monday",
                    "start_time" => "10:00",
                    "end_time" => "11:00",
                    "time_slot" => 10
                ]
            ]
        );

        $this->postJson('api/schedules', $data)
            ->assertStatus(200);
    }

    /**
     * test update schedule.
     *
     * @return void
     */
    public function test_update_schedule()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        // $data = array(
        //     "title" => "Emonff",
        //     "address" => "test address d",
        //     "contact_person" => "test dcontact",
        //     "phone" => "015382141",
        //     "email" => "emo3n011e@gmail.com",
        //     "days" => [array(
        //         "day" => "wednesday",
        //         "start_time" => "10:00",
        //         "end_time" => "12:00",
        //         "time_slot" => "20",

        //     )]
        // );
        $data = array(
            "title" => "Emonff",
            "address" => "test address d",
            "contact_person" => "test dcontact",
            "phone" => "015382141",
            "email" => "emo3n011e@gmail.com",
            "days" => [
                [
                    "day" => "Monday",
                    "start_time" => "10:00",
                    "end_time" => "11:00",
                    "time_slot" => 10
                ]
            ]
        );
        
        $schedule = Schedule::first();
        $this->putJson("api/schedules/{$schedule->id}", $data)
            ->assertStatus(200);
    }

    /**
     * test get schedules.
     *
     * @return void
     */
    public function test_get_a_schedule()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $schedule = Schedule::first();
        $this->getJson("api/schedules/{$schedule->id}")
            ->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->whereAllType([
                'id' => ['string', 'integer'],
                'title' => 'string',
                'address' => 'string',
                'contact_person' => 'string',
                'phone' => 'string',
                'email' => 'string',
                'user_id' => ['string', 'integer'],
                'created_at' => 'string',
                'updated_at' => 'string',
                'schedule_days_times' => 'array',
                'schedule_days_times.0.day' => 'string',
                'schedule_days_times.0.start_time' => 'string',
                'schedule_days_times.0.end_time' => 'string',
                'schedule_days_times.0.time_slot' => 'integer'
            ]));
    }

    /**
     * test get all schedules.
     *
     * @return void
     */
    public function test_get_all_schedules()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->getJson('api/schedules')->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->hasAll([
            'data', 'current_page', 'first_page_url', 'from', 'last_page', 'last_page_url',
            'links', 'next_page_url', 'path', 'per_page', 'prev_page_url', 'to', 'total'
        ])->whereAllType([
            'data.0.id' => ['string', 'integer'],
            'data.0.title' => 'string',
            'data.0.address' => 'string',
            'data.0.phone' => 'string'
        ]));

    }

    /**
     * test delete schedules.
     *
     * @return void
     */

    public function test_delete_schedules()
    {

//        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
//        $response->assertStatus(200);
//
//        $this->deleteJson('api/schedules/6')
//            ->assertStatus(200);
    }

}



