<div class="modal fade" id="modifier-{{ $visiteur->id }}" tabindex="-1"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">

              <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
          </div>
          <div class="modal-body ">
              <div class="col-xxl">
                  <div class="card mb-4">
                      <div
                          class="card-header d-flex align-items-center justify-content-between">
                          <h5 class="mb-0">Modifier le Visiteur</h5>
                      </div>
                      <div class="card-body">
                          <form method="POST" action="editVisiteur/{{ $visiteur->id }}">
                            @CSRF
                            <div class="row mb-3">
                              <div class="input-group col-sm-10">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>

                                <input type="text" name="nom" value="{{ $visiteur->nom }}" placeholder="Nom" aria-label="First name" class="form-control">
                                <input type="text" name="prenom" value="{{ $visiteur->prenom }}" placeholder="Prénom" aria-label="Last name" class="form-control">
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-2 col-form-label" for="basic-icon-default-company">CIN</label>
                              <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-id-card"></i></span>
                                  <input type="text" name="cin" value="{{ $visiteur->cin }}" id="basic-icon-default-id" class="form-control" placeholder=""  aria-describedby="basic-icon-default-id" />
                                </div>
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-2 form-label" for="basic-icon-default-phone">Entreprise</label>
                              <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                  <input type="text" name="entreprise" value="{{ $visiteur->entreprise }}" id="basic-icon-default-adresse" class="form-control col-sm-10" placeholder=""  aria-describedby="basic-icon-default-adresse" />
                                </div>
                              </div>
                            </div>
                            <div>
                              <label for="exampleFormControlTextarea1" class="form-label">Motif de visite</label>
                              <textarea class="form-control" id="exampleFormControlTextarea1" name="motif" rows="2">{{ $visiteur->motif }}</textarea>
                            </div>
                            <div class="mb-3">
                              <label for="exampleFormControlSelect1" class="form-label">Badge</label>
                              <select disabled class="form-select"  id="exampleFormControlSelect1" aria-label="Default select example">
                                <option value="{{ $visiteur->badge->id }}" selected>{{ $visiteur->badge->reference }}</option>
                              </select>
                              <input type="hidden" name="badge_id" value="{{ $visiteur->badge->id }}">
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
