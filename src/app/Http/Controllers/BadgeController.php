<?php

namespace App\Http\Controllers;

use App\Http\Requests\BadgeRequest;
use App\Models\Badge;
use App\Models\BadgeType;

class BadgeController extends Controller
{
    public function index()
    {
      $badges = Badge::whereNotNull('id')->get();
      $types = BadgeType::whereNotNull('id')->get();
      return view('content.badges')->with('badges',$badges)->with('types',$types);
    }


    public function store(BadgeRequest $request)
    {
        $validated = $request->validated();
        Badge::create($validated);
        return redirect('/badges');
    }


    public function update(BadgeRequest $request,$id){
      $validated = $request->validated();
      if(isset($validated['taken']))
          $validated['taken'] = 1;
      else
          $validated['taken'] = 0;
      Badge::where('id',$id)->update($validated);
      return redirect('/badges');
    }


    public function destroy($id){
      Badge::where('id',$id)->delete();
      return redirect('/badges');
    }

}
