<div class="modal fade" id="disable-{{ $salarie->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
      <div class="modal-content">
          <div class="modal-header">

              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body ">

            <div class="col-xxl">
              <div class="container">
                  <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                      <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Desactiver le salarier</h3>
                  </div>
                  <br>
                  <form action="/desactive-salarie/{{ $salarie->id }}" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="name">Nature de depart</label>
                          <select class="select-form form-select" name="nature_depart" id="" required>
                            <option value="" selected disabled></option>
                            <option value="1">Démission
                            </option>
                            <option value="2">Licenciement
                            </option>
                          </select>
                       </div>


                      <button type="submit" class="btn btn-primary float-end mt-4">Desactive</button>
                  </form>
              </div>
          </div>
      </div>
            <form action="" method="POST">
              @csrf


          </form>
          </div>
        </div>
  </div>
</div>
