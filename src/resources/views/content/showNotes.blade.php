@extends('layouts/contentNavbarLayout')

@section('title', 'Services ')

@section('content')
@can('download-note')
@php
  $fileName = $salarie->nom.'-'.$salarie->prenom.'-'.$notes->first()->annee.'.pdf';
@endphp
<a href="{{ Route('download.pdf',$fileName) }}" class="btn btn-primary float-end"><i class='bx bx-download'></i></a>
@endcan
<div class="container">
  <h1>Evaluation de {{ $salarie->nom }} &nbsp; {{ $salarie->prenom }}</h1>

    <div class="table-responsive">
      <table class="table table-borderless">
        <thead>
          <tr>
            <th class="fs-big" style="width: 32%;"></th>
            <th class="fs-big " style="width: 10%;">Note sur 5</th>
            <th class="fs-big" style="width: 15%;">Appréciation </th>
            <th class="fs-big" style="width: 43%;">Remarques </th>
            <th>      <a href="/notes" class="btn btn-outline-danger float-end" style="position:absolute;margin-top:35px;margin-left:-40px;z-index:1">X</a>
            </th>
          </tr>
        </thead>

      </table>
    </div>

    @foreach ($groupedSubCategories as $noteCategoryId => $subCategories)
    @php
      $noteCategorie = App\Models\NoteCategorie::find($noteCategoryId);
    @endphp
    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-borderless">
            <thead>
              <tr>
                <th class="fs-large invert-text-dark">{{ $subCategories->first()->categorie->name }}</th>
              </tr>
            </thead>
            @foreach ($subCategories as $subCategorie)
            @php
              $note = $groupedNotes->get($subCategorie->id)->first();
            @endphp
            <tbody>
              <tr style="margin:5px !important;">
                <td style="width: 30%;">{{ $subCategorie->name }}</td>
                <td style="width: 10%;" data-category="{{ $subCategorie->note_categorie_id }}" id="note-{{ $subCategorie->id }}">
                  {{ $note->note }}
                </td>
                <td style="width: 15%;border-radius:5px;color:white" >
                  <button class="btn" style="width:100%;color:white" id="appreciation-{{ $subCategorie->id }}"></button>
                </td>
                <td style="width: 45%;">{{ $note->remarque }}</td>
              </tr>
            </tbody>
            @endforeach
          </table>
        </div>
      </div>
      <div class="row mb-3 float-center" style="margin-left: 15px">
        <label class="col-sm-4 col-form-label fs-large"> Note {{ $subCategories->first()->categorie->name }}</label>
        <div class="col-sm-4 mt-2">
          <input type="text" id="average-note-{{ $subCategorie->note_categorie_id }}" class="form-control" disabled>
        </div>
      </div>
    </div>
    @endforeach
    <div class="row mb-3 float-center text-center" style="margin: auto">
      <label class="col-sm-4 col-form-label fs-large"> Note Finale</label>
      <div class="col-sm-4">
        <input type="text" id="finale-note" class="form-control" value="{{ $remarque->note_final }}" disabled>
      </div>
    </div>
<hr>

    <div>
      <label for="exampleFormControlTextarea1" class="form-label">Points forts</label>
      <textarea class="form-control" name="point_fort" id="exampleFormControlTextarea1" rows="3"  disabled>{{ $remarque->point_fort }}</textarea>
    </div>
    <div>
      <label for="exampleFormControlTextarea1" class="form-label">Points à améliorer</label>
      <textarea class="form-control" name="point_ameliorer" id="exampleFormControlTextarea1" rows="3" disabled>{{ $remarque->point_ameliorer }}</textarea>
    </div>
    <div>
      <label for="exampleFormControlTextarea1" class="form-label">Projet professionnel et perspectives</label>
      <textarea class="form-control" name="projet" id="exampleFormControlTextarea1" rows="3" disabled>{{ $remarque->projet }}</textarea>
    </div>
    <div>
      <label for="exampleFormControlTextarea1" class="form-label">Actions pour la période à venir</label>
      <textarea class="form-control" name="action" id="exampleFormControlTextarea1" rows="3" disabled>{{ $remarque->action }}</textarea>
    </div>
    <div>
      <label for="exampleFormControlTextarea1" class="form-label">Commentaires</label>
      <textarea class="form-control" name="commentaire" id="exampleFormControlTextarea1" rows="3" disabled>{{ $remarque->commentaire }}</textarea>
    </div>
  </div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Calculate appreciation and average notes on page load
    const noteElements = document.querySelectorAll('[id^="note-"]');
    const categoryIds = new Set();

    noteElements.forEach(noteElement => {
      const noteValue = parseFloat(noteElement.textContent.trim());
      const subCategoryId = noteElement.id.split('-')[1];
      const categoryId = noteElement.dataset.category;

      appreciation(subCategoryId, noteValue);
      categoryIds.add(categoryId);
    });

    categoryIds.forEach(categoryId => calculateAverage(categoryId));
  });

  function appreciation(subCategorieId, value) {
    const appreciationElement = document.getElementById(`appreciation-${subCategorieId}`);

    let appreciationText = '';
    let backgroundColor = '';

    switch (value) {
      case 1:
        appreciationText = 'A améliorer';
        backgroundColor = '#FF0000';
        break;
      case 2:
        appreciationText = 'Insuffisant';
        backgroundColor = '#ED7D31';
        break;
      case 3:
        appreciationText = 'Moyen';
        backgroundColor = '#FFC000';
        break;
      case 4:
        appreciationText = 'Bon';
        backgroundColor = '#A9D08E';
        break;
      case 5:
        appreciationText = 'Excellent';
        backgroundColor = '#70AD47';
        break;
      default:
        appreciationText = '';
        backgroundColor = '';
    }

    if (appreciationElement) {
      appreciationElement.textContent = appreciationText;
      appreciationElement.style.backgroundColor = backgroundColor;
    }
  }

  function calculateAverage(categoryId) {
    const inputs = document.querySelectorAll(`td[data-category="${categoryId}"]`);
    let sum = 0;
    let count = 0;

    inputs.forEach(input => {
      const value = parseFloat(input.textContent.trim());
      if (!isNaN(value)) {
        sum += value;
        count++;
      }
    });

    const average = count > 0 ? (sum / count).toFixed(2) : '';
    const averageInput = document.getElementById(`average-note-${categoryId}`);
    if (averageInput) {
      averageInput.value = average;
    }

    // Update final note
  }


</script>

@endsection
