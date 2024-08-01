<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\ContratTypes;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
      $this->authorize('type-documents');
      $documents = Document::whereNotNull('id')->get();
      $contratTypes = ContratTypes::whereNotNull('id')->get();
      return view('content.documents')->with('documents',$documents)->with('contratTypes',$contratTypes);
    }

    public function store(DocumentRequest $request)
    {
      $this->authorize('add-type-document');
      try{
      $validated = $request->validated();
      $document = Document::create(['name'=>$validated['name']]);
      $document->contratTypes()->attach($validated['contratTypes']);

      return redirect('/documents')->with('success','Le documents est bien ajouter.');
      } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::error($e);

      return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
      }
    }


  public function update(DocumentRequest $request, $id)
  {
    $this->authorize('edit-type-document');
    try{
      $validated = $request->validated();
      $document = Document::findOrFail($id);
      $document->update(['name'=> $validated['name']]);
      $document->contratTypes()->sync($validated['contratTypes']);

      return redirect('/documents')->with('success','Le document est bien modifier.');
    } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::error($e);

      return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
  }

  public function destroy($id){
    $this->authorize('delete-type-document');
    try{
    Document::where('id',$id)->delete();
    return redirect('/documents')->with('success','Le document est bien supprimer.');
    } catch (\Exception $e) {
    \Illuminate\Support\Facades\Log::error($e);

    return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
  }

  public function download($path)
    {
      
        $fullPath = 'public/' . $path; // Add 'public/' to access the file in storage
        Log::info('Full path: ' . $fullPath);

        if (Storage::exists($fullPath)) {
            Log::info('File exists');
            return Storage::download($fullPath);
        }

        Log::warning('File not found: ' . $fullPath);
        return abort(404, 'File not found');
    }

}
