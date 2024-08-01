<?php

namespace App\Http\Controllers;

use App\Helpers\VisiteurHelper;
use App\Http\Requests\VisiteurRequest;
use App\Models\Visiteur;

class VisiteurController extends Controller
{
    public function index()
    {
      $this->authorize('visits');
        $visiteurs = Visiteur::whereNotNull('id')->with('badge')->orderBy('entrer', 'desc')->get();
        $badges = VisiteurHelper::getInviterBadges();

        return view('content.visiteurs')->with('visiteurs', $visiteurs)->with('badges', $badges);
    }

    public function store(VisiteurRequest $request)
    {
      $this->authorize('add-visit');
      try{
        $validated = $request->validated();
        $validated['entrer'] = now();
        Visiteur::create($validated);
        VisiteurHelper::setBadgeTaken($validated['badge_id'], 1);

        return redirect('/visiteurs')->with('success','La Visite est bien enregistrer.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function update(VisiteurRequest $request, $id)
    {
      $this->authorize('edit-visit');
      try{
        $validated = $request->validated();
        Visiteur::where('id', $id)->update($validated);

        return redirect('/visiteurs')->with('success','La visite est bien modifier.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function destroy($id)
    {
      $this->authorize('delete-visit');
      try{
        $visiteur = VisiteurHelper::findVisiteur($id);
        VisiteurHelper::setBadgeTaken($visiteur->badge_id, 0);
        $visiteur->delete();

        return redirect('/visiteurs')->with('success','La Visite est bien modifier.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
     }
    }

    public function retour($visiteur)
    {
      $this->authorize('retour-badge');
      try{
        $visiteurInstance = VisiteurHelper::findVisiteur($visiteur);
        $visiteurInstance->update(['sortie' => now()]);
        VisiteurHelper::setBadgeTaken($visiteurInstance->badge_id, 0);

        return redirect('/visiteurs')->with('success','La Sortie du visiteur est bien enregistrer.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }
}
