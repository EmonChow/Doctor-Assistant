<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
   /**
     * A basic feature test create department.
     *
     * @return void
     */
    public function test_create_department()
    {
       
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);


        
        $data = array(
            "name" => "pagla emon edit",
            "description" => "pagla emoner desc",
            "department_examinations"=> [
               [
                "name" => "Monday",
                "examination_fields" => [
                    [
                        "title" => "dddd",
                        "field_type" => "Date"
                    ]
                ]
               ]
            ]
          );

        $this->postJson('api/department', $data)
            ->assertStatus(200);

        $this->assertDatabaseHas('departments', $data);
    }

    /**
     * test update department.
     *
     * @return void
     */
    public function test_update_department()
    {
        
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
       
        $data = array(
            "name" => "pagla emon edit",
            "description" => "pagla emoner desc",
            "department_examinations"=> [
               [
                "name" => "Monday",
                "examination_fields" => [
                    [
                        "title" => "dddd",
                        "field_type" => "Date"
                    ]
                ]
               ]
            ]
          );

        $this->json('PUT', 'api/department/1', $data)
            ->assertStatus(200);
        $this->assertDatabaseHas('doses', $data);
    }

    /**
     * test get department.
     *
     * @return void
     */
    public function test_get_a_department()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/department/3')
            ->assertStatus(200);
    }

    /**
     * test get all department.
     *
     * @return void
     */
    public function test_get_all_department()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->json('GET', 'api/department')
            ->assertStatus(200);
    }
    /**
     * test delete department.
     *
     * @return void
     */

    public function test_delete_department()
    {

        // $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        // $response->assertStatus(200);

        // $this->json('DELETE', 'api/department/1')
        //     ->assertStatus(200);
    }
}
