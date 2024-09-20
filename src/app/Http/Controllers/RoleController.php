<?php

// app/Http/Controllers/RoleController.php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
      $this->authorize('roles');
        $roles = Role::with('permissions')->get();
        $permissions = Permission::whereNotNull('id')->get();

        return view('content.roles', compact('roles'), compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
      $this->authorize('add-role');
      try{
        $validated = $request->validated();

        $role = Role::create(['name' => $validated['name']]);

        $role->permissions()->attach($validated['permissions']);

        return redirect()->route('roles')->with('success','Le Role est bien ajouter.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function update(RoleRequest $request, $id)
    {
      $this->authorize('edit-role');
      try{
        $validated = $request->validated();

        $role = Role::findOrFail($id);
        $role->update(['name' => $validated['name']]);
        $role->permissions()->sync($validated['permissions']);

        return redirect()->route('roles')->with('success','Le Role est bien modifier.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function destroy($id)
    {
      $this->authorize('delete-role');
      try{
        PermissionRole::where('role_id', $id)->delete();
        Role::find($id)->delete();

        return redirect()->route('roles')->with('success','Le Role est bien supprimer.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

}
