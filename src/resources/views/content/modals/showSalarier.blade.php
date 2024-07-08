<div class="modal fade" id="show-{{ $salarie->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="col-xxl">
                    <div class="card-body">

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Nom</label>
                                <input class="form-control" type="text" id="firstName" name="firstName"
                                    value="{{ $salarie->nom }}" autofocus="" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Prénom</label>
                                <input class="form-control" type="text" name="lastName" id="lastName"
                                    value="{{ $salarie->prenom }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">CIN</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    value={{ \App\Helpers\SalarierHelper::formatCin($salarie->cin) }}
                                    placeholder="john.doe@example.com" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="organization" name="organization"
                                    value="{{ $salarie->adresse }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">CNSS</label>


                                <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                    placeholder="" value="{{ $salarie->cnss }}" disabled>

                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Situation Familiale</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder=""
                                    value={{ \App\Helpers\SalarierHelper::formatSituationFamiliale($salarie->situation_familiale) }} disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">Date de Naissance</label>
                                <input class="form-control" type="date" id="state" name="state" placeholder=""
                                    value={{ $salarie->date_naissance }} disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Date Debut</label>
                                <input type="date" class="form-control" id="zipCode" name="zipCode" placeholder=""
                                    value={{ $salarie->date_debut }} disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Date Fin</label>
                                <input type="date" class="form-control" disabled id="zipCode" name="zipCode" placeholder=""
                                    value={{ $salarie->date_fin }} >
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="" class="form-label">Status</label> <br>
                                @if ($salarie->active)
                                    <span class="badge bg-label-success">Active</span>
                                @else
                                    <span class="badge bg-label-warning">Inactive</span>
                                @endif
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="" class="form-label">
                                Badge <br>
                                {{ $salarie->badge->reference ?? '' }}
                              </label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
