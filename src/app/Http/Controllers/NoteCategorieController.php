<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteCategorieRequest;
use App\Models\NoteCategorie;

class NoteCategorieController extends Controller
{

    public function index()
    {
      $this->authorize('categorie-notes');
        $noteCategories = NoteCategorie::whereNotNull('id')->get();

        return view('content.noteCategories')->with('categories', $noteCategories);
    }

    public function store(NoteCategorieRequest $request)
    {
      $this->authorize('add-categorie-note');
      try{
        $validated = $request->validated();
        NoteCategorie::create($validated);

        return redirect('/note-categories')->with('success','La Categorie est bien ajouter.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
     }
    }

    public function update(NoteCategorieRequest $request, $id)
    {
      $this->authorize('edit-categorie-note');
      try{
        $validated = $request->validated();
        NoteCategorie::where('id', $id)->update($validated);

        return redirect('/note-categories')->with('success','La categorie est bien modifier.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

    public function destroy($id)
    {
      $this->authorize('delete-categorie-note');
      try{
        NoteCategorie::where('id', $id)->delete();

        return redirect('/note-categories')->with('success','La categorie est bien supprimer.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }

}
