<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContratTypesRequest;
use App\Models\ContratTypes;
use Illuminate\Http\Request;

class ContratTypeController extends Controller
{
  public function index()
  {
    $types = ContratTypes::whereNotNull('id')->get();
    return view('content.contratTypes')->with('types',$types);
  }


  public function store(ContratTypesRequest $request)
  {
      $validated = $request->validated();
      ContratTypes::create($validated);
      return redirect('/contratTypes');
  }


  public function update(ContratTypesRequest $request,$id){
    $validated = $request->validated();
    ContratTypes::where('id',$id)->update($validated);
    return redirect('/contratTypes');
  }

  public function destroy($id){
    ContratTypes::where('id',$id)->delete();
    return redirect('/contratTypes');
  }
}
