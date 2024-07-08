<div class="modal fade" id="edit-{{ $permission->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">

              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="col-xxl">


                      <div class="container">
                          <h1>Modifier Permission</h1>
                          <form action="{{ route('permissions.update',$permission->id) }}" method="POST">
                              @csrf
                              @method('PUT')

                              <div class="mb-3">
                                  <label for="name" class="form-label">Permission Name</label>
                                  <input type="text" class="form-control" id="name" name="name"
                                      value="{{ old('name', $permission->name) }}" required>
                              </div>



                              <button type="submit" class="btn btn-primary">Modifier la Permission</button>
                          </form>
                      </div>


                  </div>
              </div>
          </div>
      </div>
  </div>
