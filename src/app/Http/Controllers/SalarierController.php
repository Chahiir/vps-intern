<?php

namespace App\Http\Controllers;

use App\Helpers\SalarierHelper;
use App\Http\Requests\SalarierRequest;
use App\Models\Badge;
use App\Models\BadgeType;
use App\Models\ContactUrgence;
use App\Models\ContratTypes;
use App\Models\Document;
use App\Models\Log;
use App\Models\Salarier;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SalarierController extends Controller
{
    public function index()
    {
        $this->authorize('salaries');

        $salaries = Salarier::whereNotNull('id')->with('badge')->orderBy('active', 'desc')->get();
        $contrats = ContratTypes::whereNotNull('id')->get();

        return view('content.salariers')->with('salaries', $salaries)->with('contrats', $contrats);
    }

    public function show($id)
    {
      $this->authorize('show-salarie');
        $salarie = Salarier::findOrFail($id);
        $contactUrgences = ContactUrgence::where('salarier_id', $id)->get();
        $documents = $salarie->type->documents;
        return view('content.showSalarie')->with('documents',$documents)->with('salarie', $salarie)->with('contactUrgences', $contactUrgences);
    }

    public function affectation()
    {
      $this->authorize('affecte-badge');
        $contrats = ContratTypes::whereNotNull('id')->get();
        return view('content.affecteBadge',compact('contrats'));
    }

    public function updateUser(Request $request, $id)
    {
      $this->authorize('edit-user');
      try{
        $user = User::where('id', $id)->first();
        $rules = [
            'email' => 'required|string',
            'password' => 'nullable|string',
            'c_password' => 'nullable|string|same:password',
            'role_id' => 'required | numeric',
        ];
        $messages = [
            'email' => 'l\'email est obligatoire.',
            'role_id' => 'le role est obligatoire.',
            'c_password.same' => 'les passwords doivent correspondre.',
        ];
        $request->validate($rules, $messages);

        $user->email = $request->email;
        $user->role_id = $request->role_id;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users')->with('success', 'l\'Utilisateur est bien modifier.');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
    }

    public function desactiver(Request $request, $id)
    {
      $this->authorize('desactive-salarie');
      try{
        $salarie = Salarier::find($id);
        Badge::where('id', $salarie->badge_id)->update(['taken' => 0]);
        // DOESN'T WORK IDK WHY \/
        //$salarie->update(['badge_id'=>null,'active'=>false,'date_fin'=>today(),'nature_depart'=>$request->nature_depart]);
        $salarie->badge_id = null;
        $salarie->active = false;
        $salarie->date_fin = today();
        $salarie->nature_depart = $request->nature_depart;
        $salarie->save();

        return redirect('/salaries')->with('success','Salarier Désactivé');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }

    public function reactiveSalarie($id)
    {
      $this->authorize('active-salarie');
      try{
        Salarier::where('id', $id)->update(['active' => true, 'date_fin' => null, 'date_debut' => today(), 'nature_depart' => null]);

        return redirect('/salaries')->with('success','Le Salarier est reactiver');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }

    public function create()
    {
      $this->authorize('add-salarie');
        $contrats = ContratTypes::whereNotNull('id')->get();
        $services = Service::whereNotNull('id')->get();
        $managers = Salarier::where('is_manager',1)->get();
        return view('content.addSalarier')->with('contrats', $contrats)->with('services',$services)->with('managers',$managers);
    }

    public function store(SalarierRequest $request)
{
  $this->authorize('add-salarie');
    try {
        $validated = $request->validated();

        // Filter out empty contact entries
        $contacts = array_filter($validated['nom_contact'], function ($value) {
            return !empty($value);
        });

        $contactsCount = count($contacts);

        // Create the Salarier
        $salarier = Salarier::create(array_diff_key($validated, ['nom_contact' => '', 'phone_contact' => '', 'lien_familiale' => '', 'documents' => '']));

        // Create ContactUrgence entries
        for ($i = 0; $i < $contactsCount; $i++) {
            ContactUrgence::create([
                'salarier_id' => $salarier->id,
                'nom_contact' => $validated['nom_contact'][$i],
                'phone_contact' => $validated['phone_contact'][$i],
                'lien_familiale' => $validated['lien_familiale'][$i],
            ]);
        }

        // Create directory for the Salarier
        $salarieDirectory = 'public/documents/'.$salarier->nom . '_' . $salarier->prenom . '_' . $salarier->cin;
        Storage::makeDirectory($salarieDirectory);

        // Check and handle file upload
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $documentId => $file) {
                if ($file && $file->isValid()) {
                    // Retrieve the document name from the documents table
                    $document = Document::find($documentId);
                    if ($document) {
                        // Generate a filename with salarier name and document name
                        $filename = $salarier->nom . '_' . $salarier->prenom . '_' . $document->name . '.' . $file->getClientOriginalExtension();

                        // Store the file
                        $path = $file->storeAs($salarieDirectory, $filename);

                        // Attach the document with the path
                        $salarier->documents()->attach($documentId, ['file_path' => $path]);
                    } else {
                        }
                } else {
                    return redirect()->back()->with('error', 'Invalid fichier detecter.');
                }
            }
        }

        return redirect('/salaries')->with('success', 'le Salarier est bien ajouter.');
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}


    public function edit($id)
    {
      $this->authorize('edit-salarie');
        $salarie = Salarier::findOrFail($id);
        $contrats = ContratTypes::whereNotNull('id')->get();
        $contactUrgences = ContactUrgence::where('salarier_id', $id)->get();
        $services = Service::whereNotNull('id')->get();
        $managers = Salarier::where('is_manager',1)->get();
        $documents = $salarie->type->documents;
        return view('content.editSalarier',compact('salarie','contrats','contactUrgences','services','managers','documents'));
    }

    public function update(SalarierRequest $request, $id)
{
  $this->authorize('edit-salarie');
    try {
        $validated = $request->validated();

        // Update the Salarier details
        $salarier = Salarier::findOrFail($id);
        $salarier->update(array_diff_key($validated, ['nom_contact' => '', 'phone_contact' => '', 'lien_familiale' => '', 'documents' => '']));

        // Handle document uploads
        $salarieDirectory = 'public/documents/'.$salarier->nom . '_' . $salarier->prenom . '_' . $salarier->cin;
        Storage::makeDirectory($salarieDirectory);

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $documentId => $file) {
                if ($file && $file->isValid()) {
                    $document = Document::find($documentId);
                    if ($document) {
                        $filename = $salarier->nom . '_'. $salarier->prenom. '_' . $document->name . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs($salarieDirectory, $filename);

                        // Check if the document already exists for this salarier
                        if ($salarier->documents->contains($documentId)) {
                            // Update existing document
                            $salarier->documents()->updateExistingPivot($documentId, ['file_path' => $path]);
                        } else {
                            // Attach new document
                            $salarier->documents()->attach($documentId, ['file_path' => $path]);
                        }
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Salarier est bien Modifier');
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un problem est survenue: ' . $e->getMessage());
    }
}


    public function destroy($id)
    {
      $this->authorize('delete-salarie');
      try{
        Salarier::where('id', $id)->delete();

        return redirect('/salaries')->with('success','Le salarier est bien supprimer');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }

    public function getData(Request $request)
    {
        $type = $request->query('type');

        $employees = Salarier::where('contrat_type',$type)->get();

        if($type == 1 || $type == 2)
          $badges = Badge::where('type_id',6)->get();
        else
          $badges = Badge::where('type_id',1)->get();

        // if ($type == 'stagaire') {
        //     $contrat = ContratTypes::where('name', 'Stage')->first('id');
        //     $employees = Salarier::where('contrat_type', $contrat->id)->where('active', 1)->get();
        //     $type_badge = BadgeType::where('name', 'Stagaire')->first();
        //     $badges = Badge::where('type_id', $type_badge->id)->where('taken', 0)->get();
        // } elseif ($type == 'employer') {
        //     $contrat = ContratTypes::where('name', 'Stage')->first('id');
        //     $employees = Salarier::where('contrat_type', '!=', $contrat->id)->where('active', 1)->get();
        //     $type_badge = BadgeType::where('name', 'Salarier')->first();
        //     $badges = Badge::where('type_id', $type_badge->id)->where('taken', 0)->get();
        // } else {
        //     return response()->json([]);
        // }

        return response()->json([
            'employees' => $employees,
            'badges' => $badges,
        ]);
    }

    public function affecteBadge(Request $request)
    {
      $this->authorize('affecte-badge');
      try{
        $salarie = Salarier::where('id', $request->employe)->first();
        if ($salarie->badge_id) {
            Badge::where('id', $salarie->badge_id)->update(['taken' => 0]);

        }
        $salarie->badge_id = $request->badge;
        $salarie->save();
        Badge::where('id', $request->badge)->update(['taken' => 1]);

        return redirect('/salaries')->with('success','Le badge est bien effecter');
      } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error($e);

        return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
    }


}
