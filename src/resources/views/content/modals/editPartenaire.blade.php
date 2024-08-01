<div class="modal fade" id="modifier-{{ $partenaire->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                            <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Modifier le Partenaire
                            </h3>
                        </div>
                        <br>
                        <div class="card-body">
                          <form method="POST" id="formedit-{{ $partenaire->id }}" action="edit-partenaire/{{ $partenaire->id }}" data-parsley-validate>
                            @csrf
                            <div class="row mb-3">
                                <div class="input-group col-sm-10">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" id="nom-{{ $partenaire->id }}" value="{{ $partenaire->nom }}" name="nom" placeholder="Nom" aria-label="First name" class="form-control" required data-parsley-errors-container="#nomErroredit-{{ $partenaire->id }}">
                                    <input type="text" id="prenom-{{ $partenaire->id }}" name="prenom" value="{{ $partenaire->prenom }}" placeholder="Prénom" aria-label="Last name" class="form-control" required data-parsley-errors-container="#prenomErroredit-{{ $partenaire->id }}">
                                </div>
                                <div class="input-group col-sm-10">
                                    <span id="nomErroredit-{{ $partenaire->id }}" class="text-danger" style="margin-left:7%"></span>
                                    <span id="prenomErroredit-{{ $partenaire->id }}" class="text-danger" style="margin-left:30%"></span>
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
                                        <input type="text" name="cin" value="{{ $partenaire->cin }}" id="basic-icon-default-id" class="form-control" placeholder="" aria-describedby="basic-icon-default-id" required data-parsley-pattern="/^[A-Za-z]{1,2}[0-9]+$/" data-parsley-errors-container="#cinErroredit-{{ $partenaire->id }}"/>
                                    </div>
                                </div>
                                @error('cin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                <span id="cinErroredit-{{ $partenaire->id }}" class="text-danger" style="margin-left:23%"></span>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Entreprise</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                        <input type="text" name="entreprise" value="{{ $partenaire->entreprise }}" id="basic-icon-default-adresse" class="form-control col-sm-10" placeholder="" aria-describedby="basic-icon-default-adresse" required data-parsley-errors-container="#entrepriseErroredit-{{ $partenaire->id }}"/>
                                    </div>
                                </div>
                                @error('entreprise')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                <span id="entrepriseErroredit-{{ $partenaire->id }}" class="text-danger" style="margin-left:23%"></span>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary float-end">Send</button>
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
<script>

</script>
