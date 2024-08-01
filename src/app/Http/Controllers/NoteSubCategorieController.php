<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteSubCategorieRequest;
use App\Models\NoteCategorie;
use App\Models\NoteSubCategorie;
use App\Models\Service;
use Illuminate\Http\Request;

class NoteSubCategorieController extends Controller
{
  public function index()
  {
    $this->authorize('sous-categorie-notes');
      $noteSubCategories = NoteSubCategorie::whereNotNull('id')->get();
      $noteCategories = NoteCategorie::whereNotNull('id')->get();
      $services = Service::whereNotNull('id')->get();
      return view('content.noteSubCategories')->with('subCategories', $noteSubCategories)->with('categories',$noteCategories)->with('services',$services);
  }

  public function store(NoteSubCategorieRequest $request)
  {
    $this->authorize('add-sous-categorie-note');
    try{
      $validated = $request->validated();
      $subCategorie = NoteSubCategorie::create(['name' => $validated['name'],'note_categorie_id' => $validated['note_categorie_id']]);
      $subCategorie->services()->attach($validated['services']);

      return redirect('/note-sub-categories')->with('success','La sous categorie est bien ajouter.');
    } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::error($e);

      return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
  }

  public function update(NoteSubCategorieRequest $request, $id)
  {
    $this->authorize('edit-sous-categorie-note');
    try{
      $validated = $request->validated();
      $subCategorie = NoteSubCategorie::findOrFail($id);
      $subCategorie->update(['name'=> $validated['name'],'note_categorie_id'=>$validated['note_categorie_id']]);
      $subCategorie->services()->sync($validated['services']);
      return redirect('/note-sub-categories')->with('success','La sous categorie est bien modifier.');
    } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::error($e);

      return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
  }

  public function destroy($id)
  {
    $this->authorize('delete-sous-categorie-note');
    try{
      NoteSubCategorie::where('id', $id)->delete();

      return redirect('/note-sub-categories')->with('success','La sous categorie est bien supprimer.');
    } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::error($e);

      return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
  }
  }
}
