<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\SideNavMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Role::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $permissions = Permission::whereIn('name', collect($request->permissions)->pluck('name'))->get();

            $role = Role::create(['name' => $request->name]);
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $role = Role::with(['sideNav', 'permissions'])->findOrFail($id);
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(RoleRequest $request, $id): \Illuminate\Http\JsonResponse
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $role = Role::findOrFail($id);
        SideNavMenu::where('role_id', $role->id)->delete();
        if ($role->delete()) {
            return response()->json(['message' => 'Role deleted successfully']);
        }
        return response()->json(['message' => 'Something went wrong'], 400);
    }

    /**
     * Get all permissions form permissions table
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPermission(): \Illuminate\Http\JsonResponse
    {
        $permissions = Permission::select('icon', 'name', 'sidebar_menu', 'description', 'url', 'label')->get();
        return response()->json($permissions);
    }
}
