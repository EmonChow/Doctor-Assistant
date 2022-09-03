<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Schedule;
use App\Models\ScheduleDay;
use App\Models\ScheduleDayTime;
use App\Models\User;

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

        $this->postJson('api/schedules')
            ->assertStatus(200)
            ->assertJsonStructure([
                "title"=> "Emon d",
                "address" => "test address d",
                "contact_person" => "test dcontact",
                "phone" => "0153824414",
                "email" =>"emo3n011e@gmail.com",
            ]);

        
    }

    // /**
    //  * test update drug type.
    //  *
    //  * @return void
    //  */
    // public function test_update_drug_type()
    // {
        
    //     $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
    //     $response->assertStatus(200);
    //     $data = [
    //         'type' => "tesddose",
    //         'status' => true
    // ];

    //     $this->json('PUT', 'api/drug-type/1', $data)
    //         ->assertStatus(200);
    //     $this->assertDatabaseHas('drug_types', $data);
    // }

    // /**
    //  * test get drug type.
    //  *
    //  * @return void
    //  */
    // public function test_get_a_drug_type()
    // {

    //     $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
    //     $response->assertStatus(200);

    //     $this->json('GET', 'api/drug-type/1')
    //         ->assertStatus(200);
    // }

    // /**
    //  * test get all drug type.
    //  *
    //  * @return void
    //  */
    // public function test_get_all_drug_type()
    // {

    //     $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
    //     $response->assertStatus(200);

    //     $this->json('GET', 'api/drug-type')
    //         ->assertStatus(200);
    // }
    // /**
    //  * test delete drug type.
    //  *
    //  * @return void
    //  */

    // public function test_delete_drug_type()
    // {
    //     $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
    //     $response->assertStatus(200);

    //     $this->json('DELETE', 'api/drug-type/1')
    //         ->assertStatus(200);
    // }
}
