<?php

namespace App\Http\Controllers;

use App\Exports\PartenaireVisitesExport;
use App\Exports\SalariersExport;
use App\Exports\VisiteursExport;
use App\Http\Requests\SalarierRequest;
use App\Models\Badge;
use App\Models\BadgeType;
use App\Models\ContratTypes;
use App\Models\Salarier;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalarierController extends Controller
{
    public function index()
    {
        $salaries = Salarier::whereNotNull('id')->with('badge')->orderBy('active','desc')->get();
        $contrats = ContratTypes::whereNotNull('id')->get();
        return view('content.salariers')->with('salaries', $salaries)->with('contrats', $contrats);
    }


    public function affectation(){
      return view('content.affecteBadge');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
          $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'nullable|string',
            'role_id' => 'required | numeric',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User Updated successfully.');
    }

    public function desactiver($id){
      $salarie = Salarier::find($id);
      Badge::where('id',$salarie->badge_id)->update(['taken'=>0]);
      $salarie->badge_id = null;
      $salarie->active = false;
      $salarie->date_fin = today();
      $salarie->save();
      return redirect('/salaries');
    }

    public function reactiveSalarie($id){
      Salarier::where('id',$id)->update(['active'=>true]);
      return redirect('/ancienSalarie');
    }
    public function store(SalarierRequest $request)
    {
        $validated = $request->validated();
        Salarier::create($validated);
        return redirect()->back()->with('success', 'Data saved successfully');
    }

    public function update(SalarierRequest $request,$id){
      $validated = $request->validated();
      Salarier::where('id',$id)->update($validated);
      return redirect('/salaries');
    }

    public function destroy($id){
      Salarier::where('id',$id)->delete();
      return redirect('/salaries');
    }

    public function getData(Request $request)
    {
        $type = $request->query('type');

        if ($type == "stagaire") {
            $contrat = ContratTypes::where('name','Stage')->first('id');
            $employees = Salarier::where('contrat_type', $contrat->id)->where('active',1)->get();
            $type_badge = BadgeType::where('name','Stagaire')->first();
            $badges = Badge::where('type_id', $type_badge->id)->where('taken', 0)->get();
        } else if ($type == "employer") {
            $contrat = ContratTypes::where('name','Stage')->first('id');
            $employees = Salarier::where('contrat_type','!=' , $contrat->id)->where('active',1)->get();
            $type_badge = BadgeType::where('name','Salarier')->first();
            $badges = Badge::where('type_id', $type_badge->id)->where('taken', 0)->get();
        } else {
            return response()->json([]);
        }

        return response()->json([
            'employees' => $employees,
            'badges' => $badges
        ]);
    }

    public function affecteBadge(Request $request){
      $salarie = Salarier::where('id',$request->employe)->first();
      if($salarie->badge_id){
        Badge::where('id',$salarie->badge_id)->update(['taken'=> 0]);

      }
      $salarie->badge_id = $request->badge;
      $salarie->save();
      Badge::where('id',$request->badge)->update(['taken'=> 1]);
      return redirect('/salaries');
    }


}
