<?php

namespace Jishadp\SaasRolesPermissions\Controllers;

use Illuminate\Http\Request;
use Jishadp\SaasRolesPermissions\Datatables\RoleDataTable;
use Jishadp\SaasRolesPermissions\Models\Role;
use Jishadp\SaasRolesPermissions\Models\Permission;

class RoleController
{
    public function list(RoleDataTable $roleDataTable){
        return $roleDataTable->render('roles::list');
    }

    public function save(Request $request)
    {
        Role::create([
            'name'  => $request->name,
            'guard_name' => 'web'
        ]);
        return response()->json(['status' => true, 'messages' => "Role created successfully"]);
    }

    public function edit($id)
    {
        $role = Role::find(decrypt($id));
        return response()->json($role);
    }

    public function update(Request $request)
    {
        Role::findOrFail($request->id)->update(['name'  => $request->name]);
        return response()->json(['status' => true, 'messages' => "Role updated successfully"]);
    }

    public function delete($id)
    {
        $permission = Role::find(decrypt($id));
        $permission->delete();
        return response()->json(['status' => true, 'messages' => "Role deleted successfully"]);
    }

    public function getRolePermissions($id)
    {
        $role = Role::findOrFail(decrypt($id));
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::all();
        $groupedPermissions = $permissions->groupBy('category');
        return view('roles::permissions',compact('role','permissions','rolePermissions','groupedPermissions'));
    }

    public function permissionAdd(Request $request)
    {
        $role = Role::findOrFail(decrypt($request->id));
        $permissions = $request->input('permission', []);
        connectOwnerDatabase();
        $role->syncPermissions($permissions);
        return redirect()->route('saas.roles.list');
    }
}
