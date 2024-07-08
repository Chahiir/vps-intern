<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNotNull('id')->get();
        $roles = Role::whereNotNull('id')->get();

        return view('content.users', compact('users', 'roles'));
    }

    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User Created successfully.');
    }

    // public function update(Request $request, $id)
    // {
    //     dd($request);
    //     $user = User::where('id', $id)->first();
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|string',
    //         'password' => 'nullable|string',
    //         'role_id' => 'required | numeric',
    //     ]);
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->role_id = $request->role_id;
    //     if ($request->filled('password')) {
    //         $user->password = bcrypt($request->password);
    //     }

    //     $user->save();

    //     return redirect()->route('users.index')->with('success', 'User Updated successfully.');
    // }

    public function destroy( $id)
    {

        User::find($id)->delete();
        return redirect()->route('users.index') ;
    }


}
