@extends('layouts/contentNavbarLayout')

@section('title', 'Visiteurs')



@section('content')
    <br><br>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills" style="margin-left:40% " role="tablist">
              @can('add-visit')
                <li class="nav-item">
                    <button type="button" class="nav-link active" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-within-card-active" role="tab">Inviter</button>
                </li>
                @endcan
                @can('add-visit-partenaire')
                <li class="nav-item">
                    <button type="button" class="nav-link" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-within-card-link" role="tab">Partenaire</button>
                </li>
                @endcan
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="navs-pills-within-card-active" role="tabpanel">
                    <div class="card-body">
                      @can('add-visit')
                        <form action="{{ url('/add-visiteur') }}" method="POST" id="visiteur" data-parsley-validate>
                            @CSRF
                            <div class="row mb-3">
                                <div class="input-group col-sm-10">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>

                                    <input type="text" name="nom" placeholder="Nom" aria-label="First name"
                                        class="form-control" required  data-parsley-errors-container="#nomError">
                                    <input type="text" name="prenom" placeholder="Prénom" aria-label="Last name"
                                        class="form-control" required  data-parsley-errors-container="#prenomError">
                                </div>
                                <div class="input-group col-sm-10">
                                  <span id="nomError" class="text-danger"  style="margin-left:7%"></span>
                                  <span id="prenomError" class="text-danger" style="margin-left:30%"></span>
                                </div>
                                @if ($errors->has('nom') || $errors->has('prenom'))
                                    <span class="text-danger">{{ $errors->first('nom') ?? $errors->first('prenom') }}</span>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-company">CIN</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-company2" class="input-group-text"><i
                                                class="bx bx-id-card"></i></span>
                                        <input type="text" name="cin" id="basic-icon-default-id" class="form-control"
                                            placeholder="" aria-describedby="basic-icon-default-id" required data-parsley-pattern="/^[A-Za-z]{1,2}[0-9]+$/"
                                            required data-parsley-errors-container="#cinError"/>

                                    </div>
                                    <span id="cinError" class="text-danger"  style="margin-left:23%"></span>
                                    @error('cin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Entreprise</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                class="bx bx-buildings"></i></span>
                                        <input type="text" name="entreprise" id="basic-icon-default-adresse"
                                            class="form-control col-sm-10" placeholder=""
                                            aria-describedby="basic-icon-default-adresse" required data-parsley-errors-container="#entrepriseError"/>

                                    </div>
                                    <span id="entrepriseError" class="text-danger"  style="margin-left:23%"></span>

                                    @error('entreprise')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="exampleFormControlTextarea1" class="form-label">Motif de visite</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="motif" rows="2" required data-parsley-errors-container="#motifError"></textarea>
                                <span id="motifError" class="text-danger"  style="margin-left:23%"></span>

                                @error('motif')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Badge</label>
                                <select class="select2 form-select" name="badge_id" id=""
                                    aria-label="Default select example" required data-parsley-errors-container="#badgeError">
                                    <option selected disabled>Badges</option>
                                    @foreach ($badgesV as $badge)
                                        <option value="{{ $badge->id }}">{{ $badge->reference }}</option>
                                    @endforeach
                                </select>
                                <span id="badgeError" class="text-danger"  style="margin-left:23%"></span>

                                @error('badge_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary float-end">Send</button>
                                </div>
                            </div>
                        </form>
                        @endcan
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-within-card-link" role="tabpanel">
                    <div class="card-body">
                      @can('add-visit-partenaire')
                        <form action="{{ url('/add-partenaire-visit') }}" id="partenaire" data-parsley-validate method="POST">
                            @CSRF
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Partenaires</label>
                                <select class="select2 form-select" name="partenaire_id" id="exampleFormControlSelect1"
                                    aria-label="Default select example" required>
                                    <option selected disabled>Partenaires</option>
                                    @foreach ($partenaires as $partenaire)
                                        <option value="{{ $partenaire->id }}">{{ $partenaire->nom }} &nbsp;
                                            {{ $partenaire->prenom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="exampleFormControlTextarea1" class="form-label">Motif de visite</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="motif" rows="2" required></textarea>
                            </div>
                            @error('motif')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Badge</label>
                                <select class="select2 form-select" name="badge_id" id=""
                                    aria-label="Default select example" required>
                                    <option selected disabled>Badges</option>
                                    @foreach ($badgesP as $badge)
                                        <option value="{{ $badge->id }}">{{ $badge->reference }}</option>
                                    @endforeach
                                </select>
                                @error('badge_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary float-end">Send</button>
                                </div>
                            </div>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
