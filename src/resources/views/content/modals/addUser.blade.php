<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                            <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Ajouter un utilisateur
                            </h3>
                        </div>
                        <br>
                        <div class="card-body">
                            <form method="POST" action="add-user" data-parsley-validate>
                                @CSRF
                                @method('POST')
                                <div class="mb-3">
                                  <label for="exampleFormControlSelect1" class="form-label">Salariers</label>
                                  <select class="select2 form-select" name="salarier_id" id="exampleFormControlSelect1"
                                      aria-label="Default select example" required>
                                      <option selected disabled>Salariers</option>
                                      @foreach ($salariers as $salarier)
                                          <option value="{{ $salarier->id }}">{{ $salarier->nom }} &nbsp;
                                              {{ $salarier->prenom }}</option>
                                      @endforeach
                                  </select>
                              </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"
                                        for="basic-icon-default-company">E-mail</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                                    class="bx bxl-gmail"></i></span>
                                            <input type="text" name="email" value=""
                                                id="basic-icon-default-id" class="form-control" placeholder=""
                                                aria-describedby="basic-icon-default-id" data-parsley-type="email" data-parsley-errors-container="#emailError" required/>
                                        </div>
                                        <span id="emailError" class="text-danger"  style="margin-left:23%"></span>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">Password</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                    class="bx bx-key"></i></span>
                                            <input type="password" name="password" value=""
                                                id="password" class="form-control col-sm-10"
                                                required data-parsley-length="[8, 20]" data-parsley-errors-container="#passError"/>
                                        </div>
                                        <span id="passError" class="text-danger"  style="margin-left:23%"></span>

                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">Confirmer <br>
                                        Password</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                    class="bx bx-key"></i></span>
                                            <input type="password" name="c_password" value=""
                                                id="basic-icon-default-adresse" class="form-control col-sm-10"
                                                placeholder="" aria-describedby="basic-icon-default-adresse" required data-parsley-errors-container="#cpassError" data-parsley-length="[8, 20]" data-parsley-equalto="#password"/>
                                        </div>
                                        <span id="cpassError" class="text-danger"  style="margin-left:23%"></span>

                                        @error('c_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="role" class="col-sm-2 form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select name="role_id" id="role"
                                            class=" select2 form-control form-select col-sm-10" required>
                                            <option value="" selected disabled></option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('role_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <br>
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
