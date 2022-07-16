<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(RoleAndPermissionsSeeder::class);

        //  Create Super Admin
        User::factory(1)->create(['email' => 'admin@example.com', 'name' => 'Super Admin'])->each(function ($user) {
            $user->assignRole('Super Admin');
        });
    }
}
