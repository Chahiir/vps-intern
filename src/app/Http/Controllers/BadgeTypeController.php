<?php

namespace App\Http\Controllers;

use App\Http\Requests\BadgeTypeRequest;
use App\Models\BadgeType;
use Illuminate\Http\Request;

class BadgeTypeController extends Controller
{
  public function index()
  {
    $types = BadgeType::whereNotNull('id')->get();
    return view('content.badgeTypes')->with('types',$types);
  }


  public function store(BadgeTypeRequest $request)
  {
      $validated = $request->validated();
      BadgeType::create($validated);
      return redirect('/badgeTypes');
  }


  public function update(BadgeTypeRequest $request,$id){
    $validated = $request->validated();
    BadgeType::where('id',$id)->update($validated);
    return redirect('/badgeTypes');
  }

  public function destroy($id){
    BadgeType::where('id',$id)->delete();
    return redirect('/badgeTypes');
  }
}
