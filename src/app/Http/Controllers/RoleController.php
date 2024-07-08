<?php

// app/Http/Controllers/RoleController.php
namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('content.roles', compact('roles'),compact('permissions'));
    }


    public function store(RoleRequest $request)
    {
        $validated = $request->validated();

        $role = Role::create(['name' => $validated['name']]);

        $role->permissions()->attach($validated['permissions']);

        return redirect()->route('roles.index');
    }



    public function update(RoleRequest $request, $id)
    {
        $validated = $request->validated();

        $role = Role::findOrFail($id);
        $role->update(['name' => $validated['name']]);
        $role->permissions()->sync($validated['permissions']);

        return redirect()->route('roles.index');
    }

    public function destroy( $id)
    {
        PermissionRole::where('role_id',$id)->delete();
        Role::find($id)->delete();

        return redirect()->route('roles.index') ;
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->roles()->sync([$request->role_id]);

        return redirect()->route('users.index');
    }
}
