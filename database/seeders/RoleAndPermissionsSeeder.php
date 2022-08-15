<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Role Block
         */
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions(); // forget cached permissions
        $super_admin = Role::create(['name' => 'Super Admin']);
        /**
         * use $this->generatePermission($name, $args = []) to generate permission array
         * it will take two arguments first one will be the name of the permission
         * and second argument will take an array with icon, url, sidebar_menu, guard_name, description and label.
         * ie: $name = 'permission name' : string
         * ie: $args = [
         *      'icon'=> 'fontawesome icon class',
         *      'url' => '/font-end-url',
         *      'sidebar_menu'=> 1|0,
         *      'guard_name'=> 'sanctum|web|session', # use sanctum
         *      'description': 'Description',
         *      'label': 'Label'
         * ]
         *
         * use $this->generatePermissionCRUD($name, $args = []) to generate permission array for CRUD
         * it will generate 4 permissions Create, Read, Update delete by the name of create, update, show & delete
         *
         * this method will take the same arguments as $this->generatePermission()
         */

        $permissions = collect();
        $permissions->push($this->generatePermission('dashboard', ['icon' => 'fas fa-home']));
        $permissions->push($this->generatePermission('file-manager', ['url' => '/settings/file-manager', 'icon' => 'fas fa-folder', 'label' => 'File Manager']));
        $permissions->push(...$this->generatePermissionCRUD('role', ['url' => '/roles']));
        $permissions->push(...$this->generatePermissionCRUD('user', ['url' => '/users']));
        // TODO: Additional permissions will be written here
        $permissions->push(...$this->generatePermissionCRUD('drug', ['url' => '/drugs'])); // TODO: will change the url once the url has been generated from the front end

        Permission::insert($permissions->toArray());

        $this->call([
            SideNavSeeder::class
        ]);

    }

    private function generatePermission($name, $args = [])
    {
        return [
            'name' => $name,
            'icon' => array_key_exists('icon', func_get_args()[1]) ? func_get_args()[1]['icon'] : 'fas fa-bars',
            'url' => array_key_exists('url', func_get_args()[1]) ? func_get_args()[1]['url'] : "/" . Str::slug($name),
            'sidebar_menu' => array_key_exists('sidebar_menu', func_get_args()[1]) ? func_get_args()[1]['sidebar_menu'] : 1,
            'guard_name' => array_key_exists('guard_name', func_get_args()[1]) ? func_get_args()[1]['guard_name'] : 'sanctum',
            'description' => array_key_exists('description', func_get_args()[1]) ? func_get_args()[1]['description'] : '',
            'label' => array_key_exists('label', func_get_args()[1]) ? func_get_args()[1]['label'] : Str::title($name),
        ];
    }

    private function generatePermissionCRUD($name, $args = [])
    {
        $icon = array_key_exists('icon', $args) ? $args['icon'] : 'fas fa-bars';
        $url = array_key_exists('url', $args) ? $args['url'] : "/" . Str::slug($name);
        $label = array_key_exists('label', $args) ? $args['label'] : Str::title($name);
        return collect([
            $this->generatePermission("create {$name}", ['description' => "Can create {$name}", 'sidebar_menu' => 0, 'icon' => $icon]),
            $this->generatePermission("update {$name}", ['description' => "Can update {$name}", 'sidebar_menu' => 0, 'icon' => $icon]),
            $this->generatePermission("show {$name}", ['description' => "Can show {$name}", 'sidebar_menu' => 1, 'icon' => $icon, 'url' => $url, 'label' => $label]),
            $this->generatePermission("delete {$name}", ['description' => "Can delete {$name}", 'sidebar_menu' => 0, 'icon' => $icon]),
        ]);
    }
}
