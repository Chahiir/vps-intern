<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('content.permissions', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.index');
    }

    public function update(Request $request,  $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);

        Permission::where('id',$id)->update(['name' => $request->name]);

        return redirect()->route('permissions.index');
    }

    public function destroy($id)
    {
        Permission::where('id',$id)->delete();
        return redirect()->route('permissions.index');
    }
}
