<?php

namespace Tests\Feature;

use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
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
        $department = Department::first();
        $this->putJson("api/department/{$department->id}", $data)
            ->assertStatus(200);
       
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
        $department = Department::first();
        $this->getJson("api/department/{$department->id}")
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

        $this->getJson('api/department')->assertStatus(200)->assertJson(fn(AssertableJson $json) => $json->hasAll([
            'data', 'current_page', 'first_page_url', 'from', 'last_page', 'last_page_url',
            'links', 'next_page_url', 'path', 'per_page', 'prev_page_url', 'to', 'total'
        ])->whereAllType([
            'data.0.id' => ['string', 'integer'],
            'data.0.name' => 'string',
            'data.0.description' => 'string',
        ]));
    }
    /**
     * test delete department.
     *
     * @return void
     */

    public function test_delete_department()
    {
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $department = Department::first();
        $this->deleteJson("api/department/{$department->id}")
            ->assertStatus(200);
    }
}
