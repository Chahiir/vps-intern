<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
  public function index()
  {
    $this->authorize('services');
      $services = Service::whereNotNull('id')->get();

      return view('content.services')->with('services', $services);
  }

  public function store(ServiceRequest $request)
  {
    $this->authorize('add-service');
    try{
      $validated = $request->validated();
      Service::create($validated);

      return redirect('/services')->with('success','Le Service est bien ajouter.');
    } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::error($e);

      return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
  }

  public function update(ServiceRequest $request, $id)
  {
    $this->authorize('edit-service');
    try{
      $validated = $request->validated();
      Service::where('id', $id)->update($validated);

      return redirect('/services')->with('success','Le Service est bien modifier.');
    } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::error($e);

      return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
  }

  public function destroy($id)
  {
    $this->authorize('delete-salarie');
    try{
      Service::where('id', $id)->delete();

      return redirect('/services')->with('success','Le Service est bien supprimer');
    } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::error($e);

      return redirect()->back()->with('error', 'Un Problem est survenue: ' . $e->getMessage());
    }
  }
}
