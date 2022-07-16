<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $super_admin = Role::create(['name' => 'Super Admin']);

        $permissions = collect();
        $permissions->push($this->generatePermission('dashboard', []));

        $permissions->push(...$this->generatePermissionCRUD('user', ['url' => '/user']));

        dd($permissions);

    }

    private function generatePermission($name, $args = [])
    {
        return [
            'name' => $name,
            'icon' => array_key_exists('icon', func_get_args()[1]) ? func_get_args()[1]['icon'] : 'fas fa-bars',
            'url' => array_key_exists('url', func_get_args()[1]) ? func_get_args()[1]['url'] : "/" . Str::slug($name),
            'sidebar_menu' => array_key_exists('sidebar_menu', func_get_args()[1]) ? func_get_args()[1]['sidebar_menu'] : 0,
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
            $this->generatePermission("create {$name}", ['description' => "Can create {$name}", 'icon' => $icon]),
            $this->generatePermission("update {$name}", ['description' => "Can update {$name}", 'icon' => $icon]),
            $this->generatePermission("show {$name}", ['description' => "Can show {$name}", 'sidebar_menu' => 1, 'icon' => $icon, 'url' => $url, 'label' => $label]),
            $this->generatePermission("delete {$name}", ['description' => "Can delete {$name}", 'icon' => $icon]),
        ]);
    }
}
