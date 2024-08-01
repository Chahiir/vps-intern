<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContratTypesRequest;
use App\Models\ContratTypes;

class ContratTypeController extends Controller
{
    public function index()
    {
      $this->authorize('type-contrats');
        $types = ContratTypes::whereNotNull('id')->get();

        return view('content.contratTypes')->with('types', $types);
    }

    public function store(ContratTypesRequest $request)
    {
      $this->authorize('add-type-contrat');
      try{
        $validated = $request->validated();
        ContratTypes::create($validated);

        return redirect('/contrat-types')->with('success','Le type de contrat est bien ajouter.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }

    public function update(ContratTypesRequest $request, $id)
    {
      $this->authorize('edit-type-contrat');
      try{
        $validated = $request->validated();
        ContratTypes::where('id', $id)->update($validated);

        return redirect('/contrat-types')->with('success','Le type de contrat est bien modifier.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }

    public function destroy($id)
    {
      $this->authorize('delete-type-contrat');
      try{
        ContratTypes::where('id', $id)->delete();

        return redirect('/contrat-types')->with('success','Le type de contrat est bien supprimer');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }

    public function getDocuments($id)
    {
        $contratType = ContratTypes::with('documents')->find($id);
        return response()->json($contratType->documents);
    }
}
