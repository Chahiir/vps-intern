<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartenaireRequest;
use App\Models\Partenaire;

class PartenaireController extends Controller
{
    public function index()
    {
      $this->authorize('partenaires');
        $partenaires = Partenaire::whereNotNull('id')->get();

        return view('content.partenaires')->with('partenaires', $partenaires);
    }

    public function store(PartenaireRequest $request)
    {
      $this->authorize('add-partenaire');
      try{
        $validated = $request->validated();
        Partenaire::create($validated);

        return redirect('/partenaires')->with('success','Le Partenaire est bien ajouter.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function update(PartenaireRequest $request, $id)
    {
      $this->authorize('edit-partenaire');
      try{
        $validated = $request->validated();
        Partenaire::where('id', $id)->update($validated);

        return redirect('/partenaires')->with('success','Le Partenaire est bien modifier.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function destroy($id)
    {
      $this->authorize('delete-partenaire');
      try{
        Partenaire::where('id', $id)->delete();

        return redirect('/partenaires')->with('success','Le Partenaire est bien supprimer');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
     }
    }
}
