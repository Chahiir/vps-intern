<?php

namespace App\Http\Controllers;

use App\Helpers\VisiteurHelper;
use App\Http\Requests\PartenaireVisiteRequest;
use App\Http\Requests\VisiteurRequest;
use App\Models\Badge;
use App\Models\Partenaire;
use App\Models\PartenaireVisite;
use App\Models\Visiteur;
use Illuminate\Http\Request;

class VisitsController extends Controller
{
    public function index(){
      $badgesV = Badge::where('type_id',3)->get();
      $badgesP = Badge::where('type_id',7)->get();
      $partenaires = Partenaire::whereNotNull('id')->get();
      return view('content.addVisite')->with('badgesV',$badgesV)->with('badgesP',$badgesP)->with('partenaires',$partenaires);
    }

    public function storePartenaires(PartenaireVisiteRequest $request)
  {

      $validated = $request->validated();
      $validated['entrer'] = now();
      PartenaireVisite::create($validated);
      Badge::where('id',$validated['badge_id'])->update(['taken' => 1]);
      return redirect('/partenaireVisits');
  }

  public function storeVisiteur(VisiteurRequest $request)
    {
        $validated = $request->validated();
        $validated['entrer'] = now();
        Visiteur::create($validated);
        VisiteurHelper::setBadgeTaken($validated['badge_id'], 1);
        return redirect('/visiteurs');
    }
}
