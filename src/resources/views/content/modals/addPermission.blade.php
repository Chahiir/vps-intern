<div class="modal fade" id="ajouter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">

              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="col-xxl">
                  <div class="container">
                      <form action="{{ route('permissions.store') }}" method="POST">
                          @csrf
                          <div class="form-group">
                              <label for="name">Permission nom</label>
                              <input type="text" name="name" id="name" class="form-control">
                          </div>

                          <button type="submit" class="btn btn-primary">Créé Permission</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
