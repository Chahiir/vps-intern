<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartenaireRequest;
use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
  public function index()
  {
      $partenaires = Partenaire::whereNotNull('id')->get();
      return view('content.partenaires')->with('partenaires', $partenaires);
  }

  public function store(PartenaireRequest $request)
  {
      $validated = $request->validated();
      Partenaire::create($validated);
      return redirect('/partenaires');
  }

  public function update(PartenaireRequest $request,$id){
    $validated = $request->validated();
    Partenaire::where('id',$id)->update($validated);
    return redirect('/partenaires');
  }

  public function destroy($id){
    Partenaire::where('id',$id)->delete();
    return redirect('/partenaires');
  }
}
