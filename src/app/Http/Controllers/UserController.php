<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Log;
use App\Models\Role;
use App\Models\Salarier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
      $this->authorize('users');
        $users = User::whereNotNull('id')->with('salarier')->get();
        $roles = Role::whereNotNull('id')->get();
        $salariers = Salarier::whereNotNull('id')->get();

        return view('content.users', compact('users', 'roles', 'salariers'));
    }

    public function store(UserRequest $request)
    {
      $this->authorize('add-user');
        try {
            $validated = $request->validated();
            $validated['password'] = bcrypt($validated['password']);
            User::create($validated);

            return redirect()->back()->with('success', 'L\'Utilisateur est bien ajouter.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e);

            return redirect()->back()->with('error', 'Un Problem est survenue: '.$e->getMessage());
        }
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

    //     return redirect()->route('users')->with('success', 'User Updated successfully.');
    // }

    public function destroy($id)
    {
      $this->authorize('delete-user');
        try {
            User::find($id)->delete();

            return redirect()->route('users')->with('success', 'L\'Utilisateur est bien supprimer.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e);

            return redirect()->back()->with('error', 'Un Problem est survenue: '.$e->getMessage());
        }
    }

    public function showProfile()
    {
        return view('content.profile')->with('user', Auth::user());
    }

    public function editPassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required | string',
                'c_password' => 'required | string | same:password',
            ]);
            User::where('id', Auth::id())->update('password', bcrypt($request['password']));

            return redirect()->back()->with('success', 'Password bien modifier.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e);

            return redirect()->back()->with('error', 'Un Problem est survenue: '.$e->getMessage());
        }

    }

    public function logs(string $id){
      $this->authorize('logs-salarie');
      $logs = Log::where('user_id',$id)->get();
      return view('content.logs')->with('logs',$logs);
    }

    public function allLogs(){
      $this->authorize('logs');
      $logs = Log::whereNotNull('id')->get();
      return view('content.allLogs')->with('logs',$logs);
    }
}
