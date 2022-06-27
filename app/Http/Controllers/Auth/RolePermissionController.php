<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateRoleRequest;
use App\Models\Role;
use App\Models\SideNavMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function getAllPermissions()
    {
        $permissions = Permission::select('icon', 'name', 'sidebar_menu', 'description', 'url', 'label')->get();
        return response()->json($permissions);
    }

    public function getRoles(Request $request)
    {
        $roles = Role::filter($request)->get();
        return response($roles);
    }

    public function getRole($id)
    {
        $role = Role::with(['sideNav', 'permissions'])->findOrFail($id);
        return response($role);
    }

    /**
     * @throws \Exception
     */
    public function createRole(CreateRoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $permissions = Permission::whereIn('name', collect($request->permissions)->pluck('name'))->get();

            $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
            foreach ($permissions as $permission) {
                $role->givePermissionTo($permission);
            }

            $sidebar_menu = new SideNavMenu();
            $sidebar_menu->role_id = $role->id;
            $sidebar_menu->menu_json = $request->side_nav;
            $sidebar_menu->save();
            DB::commit();
            return response()->json(['message' => 'Role Created Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateRole(CreateRoleRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $permissions = Permission::whereIn('name', collect($request->permissions)->pluck('name'))->get();
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->save();
            $role->revokePermissionTo($role->permissions);
            foreach ($permissions as $permission) {
                $role->givePermissionTo($permission);
            }

            $sidebar_menu = SideNavMenu::where('role_id', $role->id)->firstOrFail();
            $sidebar_menu->role_id = $role->id;
            $sidebar_menu->menu_json = $request->side_nav;
            $sidebar_menu->save();
            DB::commit();
            return response()->json(['message' => 'Role updated Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        SideNavMenu::where('role_id', $role->id)->delete();
        if ($role->delete()) {
            return response()->json(['data' => 'Role deleted successfully']);
        }
    }
}
