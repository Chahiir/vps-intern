@extends('layouts/contentNavbarLayout')

@section('title', 'Salaries')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/mine.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/mine.js') }}"></script>

@endsection

@section('content')


    <button type="button" class="btn btn-primary col-3 mb-4 float-start" data-bs-toggle="modal" data-bs-target="#ajouter">
        Ajouter un salarie
    </button>
    <button class="btn btn-primary me-1 float-end" type="button" data-bs-toggle="collapse" data-bs-target="#data-table_filter" aria-expanded="false" aria-controls="data-table_filter">
      <i class="bx bx-filter-alt me-1"></i>
    </button>
    <div class="btn-group me-3 float-end">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bx bxs-download me-1"></i> Exporter
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonIcon">
        <li><button class="dropdown-item d-flex align-items-center" onclick="printTable()"><i class="bx bx-printer scaleX-n1-rtl"></i> Imprimer</button></li>
        <li><button class="dropdown-item d-flex align-items-center" onclick="downloadCSV('salaries')"><i class="bx bx-download scaleX-n1-rtl"></i> CSV</button></li>
        <li><button class="dropdown-item d-flex align-items-center" onclick="downloadExcel('salaries')"><i class="bx bx-download scaleX-n1-rtl"></i> Excel</button></li>
      </ul>
    </div>
    <br>
    <br><br>
    <br>
    <div class="card">
        @include('content.modals.addSalarie', ['contrats' => $contrats])
        <div class="table-responsive text-nowrap" id="print-section">
          <img src="{{ asset('assets/img/print/Picture1.jpg') }}" style="display:none;margin:auto;" class="print-header"><br>
            <h5 class="card-header">Liste des Salaries</h5>
            <table class="table table-striped"  id="data-table">
                <thead>
                    <tr>
                        <th class="action"></th>
                        <th>Nom</th>
                        <th>Badge</th>
                        <th>CIN</th>
                        <th>Contrat</th>
                        <th>Status</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @foreach ($salaries as $salarie)

                        <tr>
                          <td class="action">
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#show-{{ $salarie->id }}">
                                <i class='bx bx-plus-circle'></i>
                            </button>

                          </td>
                              <td> <span class="fw-medium">{{ $salarie->nom }}&nbsp;{{ $salarie->prenom }}</span></td>
                              <th>{{ $salarie->badge->reference ?? '' }}</th>
                              <td>{{ \App\Helpers\SalarierHelper::formatCin($salarie->cin) }}</td>
                              <td>{{ $salarie->type->name }}</td>
                              @if($salarie->active)
                                <td><span class="badge bg-label-success">Active</span></td>
                              @else
                                <td><span class="badge bg-label-warning">Inactive</span></td>
                              @endif
                            <td class="action">
                              <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                      data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                  <div class="dropdown-menu">

                                    <form action="/desactiveSalarie/{{ $salarie->id }}" method="POST">
                                      @csrf
                                      <button class="dropdown-item" type="submit"><i class="bx bx-lock-alt me-1"></i>
                                        Desactiver le salarié</button>
                                  </form>

                                      <a class="dropdown-item" data-bs-toggle="modal"
                                          data-bs-target="#modifier-{{ $salarie->id }}"><i
                                              class="bx bx-edit-alt me-1"></i> Edit</a>
                                      <form action="/deleteSalarie/{{ $salarie->id }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button class="dropdown-item" type="submit"><i class="bx bx-trash me-1"></i>
                                              Delete</button>
                                      </form>
                                  </div>
                              </div>
                          </td>

                            @include('content.modals.editSalarie', ['salarie' => $salarie])
                            @include('content.modals.showSalarier', ['salarie' => $salarie])

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




@endsection
