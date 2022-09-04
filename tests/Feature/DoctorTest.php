<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DoctorTest extends TestCase
{
   /**
     * A basic feature test create doctor.
     *
     * @return void
     */
    public function test_create_doctor()
    {
       
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);


        
        $data = array(
            "name" => "Eyyrrn",
            "photo"=> "Emon",
            "email"=> "err21@gmail.com",
            "phone"=>"0175779166",
            "password"=>"emonury",
            "password_confirmation"=>"emonury",
             "department_id"=> "2",
            "title"=>"tes6666tle",
             "description"=>"somet666string",
            "degrees"=> [
               [
                "title" => "Mgggonday",
                "description" => "fffffff",
                "doctor_id" =>"1" 
               ]
            ]
          );

        $this->postJson('api/doctor', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('doctors', $data);
    }

    /**
     * test update doctor.
     *
     * @return void
     */
    public function test_update_doctor()
    {
        
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
       
        $data = array(
            "name" => "Eyyrrn",
            "photo"=> "Emon",
            "email"=> "err21@gmail.com",
            "phone"=>"0175779166",
            "password"=>"emonury",
            "password_confirmation"=>"emonury",
             "department_id"=> "1",
            "title"=>"tes6666tle",
             "description"=>"somet666string",
            "degrees"=> [
               [
                "title" => "Mgggonday",
                "description" => "fffffff",
                "doctor_id" =>"1" 
               ]
            ]
          );

        $this->json('PUT', 'api/doctor/1', $data)
            ->assertStatus(200);
        $this->assertDatabaseHas('doctors', $data);
    }

    /**
     * test get doctor.
     *
     * @return void
     */
    public function test_get_a_doctor()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/doctor/1')
            ->assertStatus(200);
    }

    /**
     * test get all doctor.
     *
     * @return void
     */
    public function test_get_all_doctor()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/doctor')
            ->assertStatus(200);
    }
    /**
     * test delete doctor.
     *
     * @return void
     */

    public function test_delete_doctor()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('DELETE', 'api/doctor/1')
            ->assertStatus(200);
    }
}
