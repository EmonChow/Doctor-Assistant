<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
          "days"=> [
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

        $this->assertDatabaseHas('schedules', $data);
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
        
        $data = array(
          "title" => "Emonff",
          "address" => "test address d",
          "contact_person" => "test dcontact",
          "phone" => "015382141",
          "email" => "emo3n011e@gmail.com",
          "days" =>[array(
            "day" =>"wednesday", 
            "start_time" =>"10:00", 
            "end_time" =>"12:00",
            "time_slot" =>"20",
          
          )]
          );

        $this->json('PUT', 'api/schedules/1', $data)
            ->assertStatus(200);
        $this->assertDatabaseHas('schedules', $data);
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

        $this->json('GET', 'api/schedules/1')
            ->assertStatus(200);
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

        $this->json('GET', 'api/schedules')
            ->assertStatus(200);
    }
    /**
     * test delete schedules.
     *
     * @return void
     */

    public function test_delete_schedules()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('DELETE', 'api/schedules/1')
            ->assertStatus(200);
    }
   
}

    
    
