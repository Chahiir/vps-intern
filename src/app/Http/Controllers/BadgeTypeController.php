<?php

namespace App\Http\Controllers;

use App\Http\Requests\BadgeTypeRequest;
use App\Models\BadgeType;

class BadgeTypeController extends Controller
{
  public function index()
  {
    $this->authorize('type-badges');
    $types = BadgeType::whereNotNull('id')->get();
    return view('content.badgeTypes')->with('types',$types);
  }


  public function store(BadgeTypeRequest $request)
  {
    $this->authorize('add-type-badge');
    try{
      $validated = $request->validated();
      BadgeType::create($validated);
      return redirect('/badge-types')->with('success','Le type de badge est bien ajouter.');
    } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::error($e);

      return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
  }
  }


  public function update(BadgeTypeRequest $request,$id)
  {
    $this->authorize('edit-type-badge');
    try{
    $validated = $request->validated();
    BadgeType::where('id',$id)->update($validated);
    return redirect('/badge-types')->with('sucess','Le type de badge est bien modifier');
    } catch (\Exception $e) {
    \Illuminate\Support\Facades\Log::error($e);

    return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
  }

  public function destroy($id){
    $this->authorize('delete-type-bagde');
    try{
    BadgeType::where('id',$id)->delete();
    return redirect('/badge-types')->with('success','Le type de badge est bien supprimer.');
    } catch (\Exception $e) {
    \Illuminate\Support\Facades\Log::error($e);

    return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
}
  }
}
