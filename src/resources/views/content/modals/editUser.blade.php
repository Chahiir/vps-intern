<div class="modal fade" id="edit-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Modifier l'utilisateur</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="edit-user/{{ $user->id }}">
                                @CSRF
                                @method('POST')
                                <input type="text" name="test">
                                <div class="row mb-3">
                                    <input type="text" name="name" value="{{ $user->name }}" placeholder="Nom"
                                        aria-label="First name" class="form-control">
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"
                                        for="basic-icon-default-company">E-mail</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                                    class="bx bx-id-card"></i></span>
                                            <input type="text" name="email" value="{{ $user->email }}"
                                                id="basic-icon-default-id" class="form-control" placeholder=""
                                                aria-describedby="basic-icon-default-id" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">Password</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                    class="bx bx-current-location"></i></span>
                                            <input type="text" name="password" value=""
                                                id="basic-icon-default-adresse" class="form-control col-sm-10"
                                                placeholder="" aria-describedby="basic-icon-default-adresse" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">Confirmer
                                        Password</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="basic-icon-default-phone2" class="input-group-text"><i
                                                    class="bx bx-current-location"></i></span>
                                            <input type="text" name="c_password" value=""
                                                id="basic-icon-default-adresse" class="form-control col-sm-10"
                                                placeholder="" aria-describedby="basic-icon-default-adresse" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role_id" id="role" class="form-control" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                @if ($user->role_id == $role->id) selected @endif>{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
