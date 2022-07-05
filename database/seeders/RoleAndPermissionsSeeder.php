<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
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

        $permissions = collect([
            ['name' => 'dashboard', 'icon' => 'fas fa-columns', 'url' => '/dashboard', 'label' => 'Dashboard', 'description' => 'Dashboard', 'sidebar_menu' => 1, 'guard_name' => "sanctum"],
        ]);

//        $permissions->push(...$this->generatePermissionCRUD('users', '/user', 'User'));


//        echo $permissions;
//        dd(...$permissions);
        dd($this->generatePermission('Dashboard', 'url'));

    }

    private function generatePermission($name, $options)
    {
        return $options;
//        if ($optional['label'] == null) $optional['label'] = $name;
//        if ($optional['description'] == null) $optional['description'] = $name;
//
//        return collect([
//            ['name' => $name, 'icon' => $optional['icon'], 'url' => $optional['url'], 'label' => $optional['label'], 'description' => $optional['description'], 'sidebar_menu' => $optional['sidebar_menu'], 'guard_name' => "sanctum"],
//        ]);
    }


    private function generatePermissionCRUD($table, $url, $menu_label, $icon = 'fa-solid fa-bar'): Collection
    {
        return collect([
            ['name' => "create {$table}", 'description' => "Can create {$table}", "icon" => $icon, "url" => null, "label" => null, "sidebar_menu" => 0, "guard_name" => "sanctum"],
            ['name' => "update {$table}", 'description' => "Can create {$table}", "icon" => $icon, "url" => null, "label" => null, "sidebar_menu" => 0, "guard_name" => "sanctum"],
            ['name' => "show {$table}", 'description' => "Can create {$table}", "icon" => $icon, 'url' => "{$url}", 'label' => "{$menu_label}", 'sidebar_menu' => 1, "guard_name" => "sanctum"],
            ['name' => "delete {$table}", 'description' => "Can create {$table}", "icon" => $icon, "url" => null, "label" => null, "sidebar_menu" => 0, "guard_name" => "sanctum"]
        ]);
    }
}
