<div class="modal fade" id="ajouter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">

              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="col-xxl">
                  <div class="container">
                      <form action="/add-user" method="POST">
                          @csrf
                          <div class="form-group">
                              <label for="name"> Nom</label>
                              <input type="text" name="name" id="name" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="email"> E-mail </label>
                            <input type="text" name="email" id="email" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="c_password" id="c_password" class="form-control">
                          </div>
                          <div class="form-group">
                              <label for="permissions">Role</label>
                              <select name="role_id" id="role" class="form-control" >
                                    <option value="" selected disabled></option>
                                  @foreach ($roles as $role)
                                      <option value="{{ $role->id }}">{{ $role->name }}</option>
                                  @endforeach
                              </select>
                          </div>
                          <br>
                          <br>

                          <button type="submit" class="btn btn-primary float-end">Cree Utilisateur</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
