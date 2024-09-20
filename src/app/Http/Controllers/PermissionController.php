<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
      $this->authorize('permissions');
        $permissions = Permission::whereNotNull('id')->get();
        return view('content.permissions', compact('permissions'));
    }

    public function store(PermissionRequest $request)
    {
      $this->authorize('add-permission');
      try{
        $validated = $request->validated();

        Permission::create(['name' => $validated['name']]);

        return redirect()->back()->with('success','La Permission est bien ajouter.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function update(PermissionRequest $request, $id)
    {
      $this->authorize('edit-permission');
      try{
        $validated = $request->validated();

        Permission::where('id', $id)->update(['name' => $validated['name']]);

        return redirect()->back()->with('success','La Permission est bien modifier.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function destroy($id)
    {
      $this->authorize('delete-permission');
      try{
        Permission::where('id', $id)->delete();

        return redirect()->route('permissions')->with('success','La Permission est bien supprimer');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }
}
