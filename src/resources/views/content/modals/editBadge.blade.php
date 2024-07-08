<div class="modal fade" id="modifier-{{ $badge->id }}" tabindex="-1"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">

              <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="col-xxl">
                  <div class="card mb-4">
                      <div
                          class="card-header d-flex align-items-center justify-content-between">
                          <h5 class="mb-0">Modifier le badge</h5>
                      </div>
                      <div class="card-body">
                          <form method="POST" action="editBadge/{{ $badge->id }}">
                              @csrf
                              <div class="row mb-3">
                                  <label class="col-sm-2 col-form-label"
                                      for="basic-default-name">Référence</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control"
                                          id="basic-default-name" placeholder="XX-00"
                                          name="reference"
                                          value="{{ $badge->reference }}" />
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label class="col-sm-2 col-form-label"
                                      for="basic-default-company">État</label>
                                  <div class="col-sm-10">
                                      <div class="form-check form-switch">
                                          <input class="form-check-input badge-checkbox"
                                              type="checkbox" data-id="{{ $badge->id }}"
                                              id="flexSwitchCheckDefault-{{ $badge->id }}"
                                              name="taken"
                                              @if ($badge->taken == 1) checked @endif>
                                          <label class="form-check-label"
                                              for="flexSwitchCheckDefault-{{ $badge->id }}"
                                              id="label-for-checkbox-{{ $badge->id }}">{{ $badge->taken ? 'Pris' : 'Non Pris' }}</label>
                                      </div>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                  <label class="col-sm-2 col-form-label"
                                      for="basic-default-email">Type de <br> badge</label>
                                  <div class="col-sm-10">
                                      <select id="defaultSelect" class="form-select"
                                          name="type_id">
                                          <option>Type</option>
                                          @foreach ($types as $type)
                                              <option value="{{ $type->id }}"
                                                  @if ($type->id == $badge->type_id) selected @endif>
                                                  {{ $type->name }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>

                              <div class="row justify-content-end">
                                  <div class="col-sm-10">
                                      <button type="submit"
                                          class="btn btn-primary">Modifier</button>
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
