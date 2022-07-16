<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\SideNavMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SideNavSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = Role::where('name', 'Super Admin')->first();
        $this->createSuperAdminMenu($super_admin);
    }

    private function createSuperAdminMenu(Role $role)
    {
        SideNavMenu::create([
            'role_id' => $role->id,
            'menu_json' => json_encode([
                [
                    'group' => true,
                    'label' => 'core',
                    'children' => [
                        ['url' => '/dashboard', 'icon' => 'fas fa-search', 'label' => 'Dashboard']
                    ]
                ],
                [
                    'group' => true,
                    'label' => 'user management',
                    'children' => [
                        ['url' => '', 'icon' => 'fas fa-sliders-h', 'label' => 'Website Setting', 'children' => [
                            ['url' => '/site-settings/sliders', 'icon' => 'fas fa-sliders-h', 'label' => 'Slider Setting'],
                            ['url' => '/site-settings/website-data', 'icon' => 'fas fa-sliders-h', 'label' => 'Web Setting'],
                        ]],
                        ['url' => '', 'icon' => 'fas fa-user', 'label' => 'User Management', 'children' => [
                            ['url' => '/users', 'icon' => 'fas fa-user', 'label' => 'User'],
                            ['url' => '/roles', 'icon' => 'fas fa-user', 'label' => 'Role'],
                        ]],
                        ['url' => '/file-manager', 'icon' => 'fas fa-folder', 'label' => 'File Manager']
                    ]
                ]
            ])
        ]);
    }
}
