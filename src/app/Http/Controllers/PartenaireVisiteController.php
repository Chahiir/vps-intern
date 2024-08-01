<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartenaireVisiteRequest;
use App\Models\Badge;
use App\Models\BadgeType;
use App\Models\Partenaire;
use App\Models\PartenaireVisite;

class PartenaireVisiteController extends Controller
{
    public function index()
    {
      $this->authorize('visit-partenaire');
        $visiteurs = PartenaireVisite::whereNotNull('id')->orderBy('entrer', 'desc')->with('partenaire')->get();
        $partenaires = Partenaire::whereNotNull('id')->get();
        $type = BadgeType::where('name', 'Partenaire')->first();
        $badges = Badge::where('type_id', $type->id)->where('taken', 0)->get();

        return view('content.partenaireVisits')->with('visiteurs', $visiteurs)->with('badges', $badges)->with('partenaires', $partenaires);
    }

    public function store(PartenaireVisiteRequest $request)
    {
      $this->authorize('add-visit-partenaire');
      try{

        $validated = $request->validated();
        $validated['entrer'] = now();
        PartenaireVisite::create($validated);
        Badge::where('id', $validated['badge_id'])->update(['taken' => 1]);

        return redirect('/partenaire-visits')->with('success','La visite du partenaire est bien ajouter.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function update(PartenaireVisiteRequest $request, $id)
    {
      $this->authorize('edit-visit-partenaire');
      try{
        $validated = $request->validated();
        PartenaireVisite::where('id', $id)->update($validated);

        return redirect('/partenaire-visits')->with('success','La visite du partenaire est bien modifier.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function destroy($id)
    {
      $this->authorize('delete-visit-partenaire');
      try{
        $visiteur = PartenaireVisite::where('id', $id)->first();
        Badge::where('id', $visiteur->badge_id)->update(['taken' => 0]);
        $visiteur->delete();

        return redirect('/partenaire-visits')->with('La visite du partenaire est bien supprimer.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function retour($id)
    {
      $this->authorize('retour-badge');
      try{
        $visituer = PartenaireVisite::where('id', $id)->first();
        $visituer->update(['sortie' => now()]);
        Badge::where('id', $visituer->badge_id)->update(['taken' => 0]);

        return redirect('/partenaire-visits')->with('success','La sortie du partenaire est bien enregistrer.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
     }
    }
}
