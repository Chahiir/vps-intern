@extends('layouts/contentNavbarLayout')

@section('title', 'Visiteurs')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/mine.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

@endsection

@section('vendor-script')

    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/mine.js') }}"></script>
@endsection

@section('content')


<div class="mb-3">
  <label for="exampleFormControlSelect1" class="form-label">Type Visiteur</label>
  <select class="form-select" id="selectType" aria-label="Default select example" onchange="divChange()">
    <option selected disabled></option>
    <option value="1">Inviter</option>
    <option value="2">Partenaire</option>
  </select>
</div>

<div class="card mb-4" id="visiteur" style="display: none">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="mb-0">Visiteur</h5> <small class="text-muted float-end"></small>
  </div>
  <div class="card-body">
    <form action="{{ url('/addVisiteur') }}" method="POST">
      @CSRF
      <div class="row mb-3">
        <div class="input-group col-sm-10">
          <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>

          <input type="text" name="nom" placeholder="Nom" aria-label="First name" class="form-control">
          <input type="text" name="prenom" placeholder="Prénom" aria-label="Last name" class="form-control">
        </div>
        @if ($errors->has('nom') || $errors->has('prenom'))
        <span class="text-danger">{{ $errors->first('nom') ?? $errors->first('prenom') }}</span>
      @endif
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label" for="basic-icon-default-company">CIN</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-id-card"></i></span>
            <input type="text" name="cin" id="basic-icon-default-id" class="form-control" placeholder=""  aria-describedby="basic-icon-default-id" />

          </div>
          @error('cin')
              <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-2 form-label" for="basic-icon-default-phone">Entreprise</label>
        <div class="col-sm-10">
          <div class="input-group input-group-merge">
            <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-buildings"></i></span>
            <input type="text" name="entreprise" id="basic-icon-default-adresse" class="form-control col-sm-10" placeholder=""  aria-describedby="basic-icon-default-adresse" />

          </div>
          @error('entreprise')
          <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>
      <div>
        <label for="exampleFormControlTextarea1" class="form-label">Motif de visite</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="motif" rows="2"></textarea>
        @error('motif')
            <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
      <div class="mb-3">
        <label for="exampleFormControlSelect1" class="form-label">Badge</label>
        <select class="form-select" name="badge_id" id="exampleFormControlSelect1" aria-label="Default select example">
          <option selected>Badges</option>
          @foreach($badgesV as $badge)
            <option value="{{ $badge->id }}">{{ $badge->reference }}</option>
          @endforeach
        </select>
        @error('badge_id')
            <span class="text-danger">{{ $message }}</span>
          @enderror
      </div>
      <div class="row justify-content-end">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Send</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- PARTENAIRE -->


              <div class="card mb-4" id="partenaire" style="display: none">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="mb-0">Visiteur</h5> <small class="text-muted float-end"></small>
                </div>
                <div class="card-body">
                  <form action="{{ url('/addPartenaireVisit') }}" method="POST">
                    @CSRF
                    <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label">Partenaires</label>
                      <select class="form-select" name="partenaire_id" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Partenaires</option>
                        @foreach($partenaires as $partenaire)
                          <option value="{{ $partenaire->id }}">{{ $partenaire->nom  }} &nbsp; {{ $partenaire->prenom }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div>
                      <label for="exampleFormControlTextarea1" class="form-label">Motif de visite</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" name="motif" rows="2"></textarea>
                    </div>
                    @error('motif')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                    <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label">Badge</label>
                      <select class="form-select" name="badge_id" id="exampleFormControlSelect1" aria-label="Default select example">
                        <option selected>Badges</option>
                        @foreach($badgesP as $badge)
                          <option value="{{ $badge->id }}">{{ $badge->reference }}</option>
                        @endforeach
                      </select>
                      @error('badge_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                    </div>
                    <div class="row justify-content-end">
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Send</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>


  <script>
    function divChange(){
      var type = document.getElementById('selectType');
      var visiteur = document.getElementById('visiteur');
      var partenaire = document.getElementById('partenaire');

      if(type.value == 1){
        visiteur.style = "display:block";
        partenaire.style = "display:none";
      }else{
        visiteur.style = "display:none";
        partenaire.style = "display:block";
      }
    }
  </script>
@endsection
