<?php

namespace App\Http\Controllers;

use App\Http\Requests\BadgeRequest;
use App\Models\Badge;
use App\Models\BadgeType;

class BadgeController extends Controller
{
    public function index()
    {
      $this->authorize('badges');

        $badges = Badge::whereNotNull('id')->get();
        $types = BadgeType::whereNotNull('id')->get();

        return view('content.badges')->with('badges', $badges)->with('types', $types);
    }

    public function store(BadgeRequest $request)
    {
      $this->authorize('add-badge');
      try{
        $validated = $request->validated();
        Badge::create($validated);

        return redirect('/badges')->with('success','Le Badge est bien ajouter.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }

    public function update(BadgeRequest $request, $id)
    {
      $this->authorize('edit-badge');
      try{
        $validated = $request->validated();
        if (isset($validated['taken'])) {
            $validated['taken'] = 1;
        } else {
            $validated['taken'] = 0;
        }
        Badge::where('id', $id)->update($validated);

        return redirect('/badges')->with('success','Le Badge est bien modifier.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }

    public function destroy($id)
    {
      $this->authorize('delete-badge');
      try{
        Badge::where('id', $id)->delete();

        return redirect('/badges')->with('success','Le Badge est bien supprimer.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }
  }
