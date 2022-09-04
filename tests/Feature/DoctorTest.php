<?php

namespace Tests\Feature;

use App\Models\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
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
        $doctor = Doctor::first();
        $this->putJson("api/doctor/{$doctor->id}", $data)
            ->assertStatus(200);
       
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
        
        $doctor = Doctor::first();
        $this->getJson("api/doctor/{$doctor->id}")
            ->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->whereAllType([
                'id' => ['string', 'integer'],
                'name' => 'string',
                'photo' => 'string',
                'password' => 'string',
                "password_confirmation"=>'string',
                'phone' => 'string',
                'email' => 'string',
                'department_id' => ['string', 'integer'],
                'created_at' => 'string',
                'updated_at' => 'string',
                'degrees' => 'array',
                'degrees.0.title' => 'string',
                'degrees.0.description' => 'string',
                'degrees.0.doctor_id' => ['string', 'integer'],
            ]));
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

        $this->getJson('api/doctor')->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->hasAll([
            'data', 'current_page', 'first_page_url', 'from', 'last_page', 'last_page_url',
            'links', 'next_page_url', 'path', 'per_page', 'prev_page_url', 'to', 'total'
        ])->whereAllType([
            'data.0.id' => ['string', 'integer'],
            'data.0.name' => 'string',
            'data.0.photo' => 'string',
            'data.0.phone' => 'string'
        ]));
    }
    /**
     * test delete doctor.
     *
     * @return void
     */

    public function test_delete_doctor()
    {

        // $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        // $response->assertStatus(200);

        // $this->json('DELETE', 'api/doctor/1')
        //     ->assertStatus(200);
    }
}
