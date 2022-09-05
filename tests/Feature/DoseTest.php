<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Dose;

class DoseTest extends TestCase
{
   /**
     * A basic feature test create dose.
     *
     * @return void
     */
    public function test_create_dose()
    {
       
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);


        $data = [
                'dose' => "tesddode",
                'status' => false
        ];

        $this->postJson('api/doses', $data)
            ->assertStatus(200);

       
    }

    /**
     * test update dose.
     *
     * @return void
     */
    public function test_update_dose()
    {
        
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $data = [
            'dose' => "testdoeeee",
            'status' => true
    ];
        $dose =Dose::first();
        $this->putJson("api/doses/{$dose->id}", $data)
            ->assertStatus(200);
       
    }

    /**
     * test get dose.
     *
     * @return void
     */
    public function test_get_a_dose()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $dose =Dose::first();
        $this->getJson("api/doses/{$dose->id}")
            ->assertStatus(200);
    }

    /**
     * test get all doses.
     *
     * @return void
     */
    public function test_get_all_doses()
    {

        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);

        $this->getJson('api/doses')
            ->assertStatus(200);
    }
    /**
     * test delete dose.
     *
     * @return void
     */

    public function test_delete_dose()
    { 
        $response = $this->postJson('/api/login', ['email' => 'admin@example.com', 'password' => 'password']);
        $response->assertStatus(200);
        $dose =Dose::first();
        $this->deleteJson("api/doses/{$dose->id}")
            ->assertStatus(200);
    }
}
