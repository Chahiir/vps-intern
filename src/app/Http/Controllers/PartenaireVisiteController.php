<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartenaireVisiteRequest;
use App\Models\Badge;
use App\Models\BadgeType;
use App\Models\Partenaire;
use App\Models\PartenaireVisite;
use Illuminate\Http\Request;

class PartenaireVisiteController extends Controller
{
  public function index()
  {
      $visiteurs = PartenaireVisite::whereNotNull('id')->orderBy('entrer','desc')->with('partenaire')->get();
      $partenaires = Partenaire::whereNotNull('id')->get();
      $type = BadgeType::where('name','Partenaire')->first();
      $badges = Badge::where('type_id',$type->id)->where('taken',0)->get();
      return view('content.partenaireVisits')->with('visiteurs', $visiteurs)->with('badges', $badges)->with('partenaires',$partenaires);
  }

  public function store(PartenaireVisiteRequest $request)
  {

      $validated = $request->validated();
      $validated['entrer'] = now();
      PartenaireVisite::create($validated);
      Badge::where('id',$validated['badge_id'])->update(['taken' => 1]);
      return redirect('/partenaireVisits');
  }

  public function update(PartenaireVisiteRequest $request, $id)
  {

      $validated = $request->validated();
      PartenaireVisite::where('id', $id)->update($validated);
      return redirect('/partenaireVisits');
  }

  public function destroy($id)
  {
    $visiteur = PartenaireVisite::where('id', $id)->first();
    Badge::where('id',$visiteur->badge_id)->update(['taken' => 0]);
    $visiteur->delete();
    return redirect('/partenaireVisits');
  }

  public function retour($id){
    $visituer = PartenaireVisite::where('id',$id)->first();
    $visituer->update(['sortie' => now()]);
    Badge::where('id',$visituer->badge_id)->update(['taken' => 0]);
    return redirect('/partenaireVisits');
  }
}
