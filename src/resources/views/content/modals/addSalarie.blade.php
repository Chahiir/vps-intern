<div class="modal fade" id="ajouter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">

              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="col-xxl">
              <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="mb-0">Salarie</h5> <small class="text-muted float-end"></small>
                </div>
                <div class="card-body">
                  <form action="{{ url('/add-salarie') }}" method="POST">
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
                      <label class="col-sm-2 form-label" for="basic-icon-default-phone">Adresse</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-current-location"></i></span>
                          <input type="text" name="adresse" id="basic-icon-default-adresse" class="form-control col-sm-10" placeholder=""  aria-describedby="basic-icon-default-adresse" />
                        </div>
                        @error('adresse')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="basic-icon-default-phone">Contrat</label>
                      <div class="col-sm-10">
                        <select id="defaultSelect" name="contrat_type" class="form-select col-sm-10" >
                          <option>Contrat</option>
                          @foreach($contrats as $contrat)
                            <option value="{{ $contrat->id }}"> {{ $contrat->name }}</option>
                          @endforeach
                        </select>
                        @error('contrat_type')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                      </div>

                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="basic-icon-default-phone">CNSS</label>
                      <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                          <input type="text" name="cnss" id="basic-icon-default-adresse" class="form-control col-sm-10" placeholder=""  aria-describedby="basic-icon-default-adresse" />
                        </div>
                        @error('cnss')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Date de Naissance</label>
                      <div class="col-md-10">
                        <input class="form-control" name="date_naissance" type="date"  id="html5-date-input" />
                        @error('date_naissance')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="html5-date-input" class="col-md-2 col-form-label">Date de Debut</label>
                      <div class="col-md-10">
                        <input class="form-control" name="date_debut" type="date"  id="html5-date-input" />
                        @error('date_debut')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 form-label" for="basic-icon-default-phone">Situation Familiale</label>
                      <div class="col-sm-10">
                        <select id="defaultSelect" name="situation_familiale" class="form-select col-sm-10" >
                          <option disabled selected>Situation</option>
                          <option value="1">Célibataire</option>
                          <option value="2">Marié</option>
                          <option value="3">Divorcé</option>
                          <option value="4">Veuf/Veuve</option>
                        </select>
                        @error('situation_familiale')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                    </div>
                    <div class="row justify-content-end">
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Send</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>
