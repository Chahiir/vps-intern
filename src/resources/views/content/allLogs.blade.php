@extends('layouts/contentNavbarLayout')

@section('title', 'Logs')

@section('content')
<div class="card ">

<div class="card-header d-flex align-items-center justify-content-between  ">
  <h3 class="mb-8 m-4 position-absolute top-0 start-50 translate-middle">Liste des LOGS</h3>
</div>

<div class="card-body">
  <button class="btn btn-primary me-1 float-end" style="width: 10%" type="button" data-bs-toggle="collapse" data-bs-target="#data-table_filter"
        aria-expanded="false" aria-controls="data-table_filter">
        <i class='bx bx-search-alt-2'></i>
    </button>
    <br>
<br>
<div class="table-responsive text-nowrap">
  <table class="table table-striped" id="data-table">
      <thead>
          <tr>
              <th></th>
              <th>Utilisateur</th>
              <th>Action</th>
              <th>Fait le</th>
              <th>IP</th>
          </tr>
      </thead>
      <tbody class="table-border-bottom-0">

          @foreach ($logs as $log)
              <tr>
                <td class="action">
                  <button class="dropdown-item" data-bs-toggle="modal"
                  data-bs-target="#show-{{ $log->id }}"><i
                    class="bx bx-plus-circle me-1"></i>
          </button>
              </td>
                  <td>{{ $log->user->salarier->nom }} {{ $log->user->salarier->prenom }}</td>
                  <td> <span class="fw-medium">{{ $log->action }}</span></td>
                  <td>{{ $log->created_at }}</td>
                  <td>{{ $log->ip }}</td>
                  <!-- Modal -->
                  <div class="modal fade modal-xl" id="show-{{ $log->id }}" tabindex="-1"
                      aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" style="max-width: 90%;">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <div class="col-xxl">
                                      <div class="card mb-4">
                                          <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                                              <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">
                                                  Log details
                                              </h3>
                                          </div>
                                          <br>
                                          <div class="card-body">
                                            <div class="row mb-3">
                                              <label class="col-sm-2 col-form-label"
                                                  for="basic-default-name">Utilisateur</label>
                                              <div class="col-sm-10">
                                                {{ $log->user->salarier->nom }} {{ $log->user->salarier->prenom }}
                                              </div>
                                          </div>
                                              <div class="row mb-3">
                                                  <label class="col-sm-2 col-form-label"
                                                      for="basic-default-name">Action</label>
                                                  <div class="col-sm-10">
                                                      {{$log->action}}
                                                  </div>
                                              </div>
                                              <div class="row mb-3">
                                                <label for="details" class="col-sm-2 col-form-label">Description</label>
                                                <div class="col-sm-10 modal-description">
                                                  <textarea name="" id="" style="width:90%" disabled rows="10">{{ $log->description }}</textarea>
                                                </div>
                                              </div>
                                              <div class="row mb-3">
                                                <label for="details" class="col-sm-2 col-form-label">Date</label>
                                                <div class="col-sm-10">
                                                  {{ $log->created_at }}
                                                </div>
                                              </div>
                                              <div class="row mb-3">
                                                <label for="details" class="col-sm-2 col-form-label">IP</label>
                                                <div class="col-sm-10">
                                                  {{ $log->ip }}
                                                </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

              </tr>
          @endforeach
      </tbody>
  </table>
</div>
</div>
</div>
@endsection

@section('styles')
<style>
  .modal-description {
    overflow-wrap: break-word;
    word-break: break-word;
    white-space: pre-wrap; /* Preserve whitespace and wrap text */
    max-height: 400px; /* Optional: Add height limit for long text */
    overflow-y: auto; /* Optional: Add scroll if text overflows */
  }
</style>
@endsection
