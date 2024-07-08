<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisiteurRequest;
use App\Models\Badge;
use App\Models\BadgeType;
use App\Models\Visiteur;
use App\Helpers\VisiteurHelper;

class VisiteurController extends Controller
{
    public function index()
    {
        $visiteurs = Visiteur::whereNotNull('id')->with('badge')->orderBy('entrer', 'desc')->get();
        $badges = VisiteurHelper::getInviterBadges();
        return view('content.visiteurs')->with('visiteurs', $visiteurs)->with('badges', $badges);
    }

    public function store(VisiteurRequest $request)
    {
        $validated = $request->validated();
        $validated['entrer'] = now();
        Visiteur::create($validated);
        VisiteurHelper::setBadgeTaken($validated['badge_id'], 1);
        return redirect('/visiteurs');
    }

    public function update(VisiteurRequest $request, $id)
    {
        $validated = $request->validated();
        Visiteur::where('id', $id)->update($validated);
        return redirect('/visiteurs');
    }

    public function destroy($id)
    {
        $visiteur = VisiteurHelper::findVisiteur($id);
        VisiteurHelper::setBadgeTaken($visiteur->badge_id, 0);
        $visiteur->delete();
        return redirect('/visiteurs');
    }

    public function retour($visiteur)
    {
        $visiteurInstance = VisiteurHelper::findVisiteur($visiteur);
        $visiteurInstance->update(['sortie' => now()]);
        VisiteurHelper::setBadgeTaken($visiteurInstance->badge_id, 0);
        return redirect('/visiteurs');
    }
}
