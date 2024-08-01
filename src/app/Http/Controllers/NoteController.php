<?php

namespace App\Http\Controllers;

use App\Helpers\NoteHelper;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Models\Remarques;
use App\Models\Salarier;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
      $this->authorize('evaluations');
        $remarques = Remarques::whereNotNull('id')->get();
        return view('content.notes')->with('remarques', $remarques);
    }

    public function evaluate()
    {
      $this->authorize('evaluate');
        $salaries = Salarier::where('manager_id', auth()->user()->salarier_id)->get();
        return view('content.evaluate')->with('salaries', $salaries);
    }

    public function edit($id)
    {
      $this->authorize('edit-note');
        $remarque = Remarques::findOrFail($id);
        $notes = Note::where('salarie_id', $remarque->salarie_id)
                      ->where('annee', $remarque->annee)
                      ->get();
        $subCategories = $notes->first()->salarie->service->noteSubCategories;
        $groupedSubCategories = $subCategories->groupBy('note_categorie_id');
        $groupedNotes = $notes->groupBy('note_sub_categorie_id');

        return view('content.edit-note', compact('remarque', 'notes', 'groupedSubCategories', 'groupedNotes'));
    }

    public function update(NoteRequest $request, $id)
    {
      $this->authorize('edit-note');
        try {
            $validated = $request->validated();
            $remarques = Remarques::findOrFail($id);

            $remarques->update([
                'point_fort' => $validated['point_fort'],
                'point_ameliorer' => $validated['point_ameliorer'],
                'projet' => $validated['projet'],
                'action' => $validated['action'],
                'commentaire' => $validated['commentaire'],
                'note_final' => $validated['note_final'],
            ]);

            $notes = Note::where('salarie_id', $validated['salarie_id'])
                          ->where('annee', $remarques->annee)
                          ->get()
                          ->keyBy('note_sub_categorie_id');

            foreach ($validated['note'] as $index => $note) {
                $noteId = $validated['note_sub_categorie_id'][$index];
                if (isset($notes[$noteId])) {
                    $notes[$noteId]->update([
                        'note' => $note,
                        'remarque' => $validated['remarque'][$index],
                    ]);
                }
            }

            $salarie = $remarques->salarie;
            $manager = $notes->first()->manager;
            $subCategories = $salarie->service->noteSubCategories;
            $groupedSubCategories = $subCategories->groupBy('note_categorie_id');
            $groupedNotes = $notes->groupBy('note_sub_categorie_id');

            $categoryAverages = NoteHelper::calculateCategoryAverages($groupedSubCategories, $groupedNotes);

            $response = NoteHelper::generatePdf($notes, $remarques, $salarie, $manager, $groupedSubCategories, $groupedNotes, $categoryAverages);

            return response()->json($response);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function show($id)
    {
      $this->authorize('show-note');
        $remarque = Remarques::findOrFail($id);
        $notes = Note::where('salarie_id', $remarque->salarie_id)
                      ->where('annee', $remarque->annee)
                      ->get();
        $salarie = $notes->first()->salarie;
        $subCategories = $salarie->service->noteSubCategories;
        $groupedSubCategories = $subCategories->groupBy('note_categorie_id');
        $manager = $notes->first()->manager;
        $groupedNotes = $notes->groupBy('note_sub_categorie_id');

        return view('content.showNotes', compact('notes', 'remarque', 'salarie', 'manager', 'groupedSubCategories', 'groupedNotes'));
    }

    public function create(Request $request)
    {
      $this->authorize('evaluate');
        $salarie = Salarier::with('service.noteSubCategories')->findOrFail($request->salarie_id);
        $subCategories = $salarie->service->noteSubCategories;
        $groupedSubCategories = $subCategories->groupBy('note_categorie_id');
        return view('content.formEvaluation', compact('salarie', 'groupedSubCategories'));
    }

    public function store(NoteRequest $request)
    {
      $this->authorize('evaluate');
        try {
            $validated = $request->validated();
            $notes = collect();

            foreach ($validated['note'] as $index => $note) {
                $createdNote = Note::create([
                    'note' => $note,
                    'remarque' => $validated['remarque'][$index],
                    'note_sub_categorie_id' => $validated['note_sub_categorie_id'][$index],
                    'salarie_id' => $validated['salarie_id'],
                    'manager_id' => auth()->user()->id,
                    'annee' => date('Y'),
                ]);
                $notes->push($createdNote);
            }

            $remarques = Remarques::create([
                'annee' => date('Y'),
                'salarie_id' => $validated['salarie_id'],
                'point_fort' => $validated['point_fort'],
                'point_ameliorer' => $validated['point_ameliorer'],
                'projet' => $validated['projet'],
                'action' => $validated['action'],
                'commentaire' => $validated['commentaire'],
                'note_final' => $validated['note_final'],
            ]);

            $salarie = $notes->first()->salarie;
            $manager = $notes->first()->manager;
            $subCategories = $salarie->service->noteSubCategories;
            $groupedSubCategories = $subCategories->groupBy('note_categorie_id');
            $groupedNotes = $notes->groupBy('note_sub_categorie_id');

            $categoryAverages = NoteHelper::calculateCategoryAverages($groupedSubCategories, $groupedNotes);

            $response = NoteHelper::generatePdf($notes, $remarques, $salarie, $manager, $groupedSubCategories, $groupedNotes, $categoryAverages);

            return response()->json($response);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function downloadPdf($filename)
    {
      $this->authorize('download-note');
        $filePath = storage_path('app/public/pdfs/' . $filename);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath);
    }

    public function destroy($id)
    {
      $this->authorize('delete-note');
      try{
        $remarque = Remarques::findOrFail($id);
        Note::where('salarie_id', $remarque->salarie_id)
            ->where('annee', $remarque->annee)
            ->delete();

        $remarque->delete();

        return redirect('/notes')->with('success','L\'evaluation est bien supprimer.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }
}
