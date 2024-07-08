@extends('layouts/contentNavbarLayout')

@section('title', 'Badges')

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

<button class="btn btn-primary me-1 float-end" type="button" data-bs-toggle="collapse" data-bs-target="#data-table_filter" aria-expanded="false" aria-controls="data-table_filter">
  <i class="bx bx-filter-alt me-1"></i>
</button>
    <div class="btn-group me-3 mb-3 float-end mx-auto">

      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bx bxs-download me-1"></i> Exporter
      </button>

      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonIcon">
        <li><button class="dropdown-item d-flex align-items-center" onclick="printTable()"><i class="bx bx-printer scaleX-n1-rtl"></i> Imprimer</button></li>
        <li><button class="dropdown-item d-flex align-items-center" onclick="downloadCSV('badges')"><i class="bx bx-download scaleX-n1-rtl"></i> CSV</button></li>
        <li><button class="dropdown-item d-flex align-items-center" onclick="downloadExcel('badges')"><i class="bx bx-download scaleX-n1-rtl"></i> Excel</button></li>
      </ul>
    </div>
    <button type="button" class="btn btn-primary col-3 mb-4 float-start" data-bs-toggle="modal" data-bs-target="#ajouter">
        Ajouter un Badge
    </button>
    <br><br>

    <br>
    <div class="card">

        @include('content.modals.addBadge', ['types' => $types])


        <div class="table-responsive text-nowrap" id="print-section">
          <img src="{{ asset('assets/img/print/Picture1.jpg') }}" style="display:none;margin:auto;" class="print-header"><br>
          <h5 class="card-header">Liste des Badges</h5>
            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>Référence</th>
                        <th>Etat</th>
                        <th>Type</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @foreach ($badges as $badge)
                        <tr>
                            <td> <span class="fw-medium">{{ $badge->reference }}</span></td>
                            @if ($badge->taken)
                                <td><span class="badge bg-label-warning me-1">Pris</span></td>
                            @else
                                <td><span class="badge bg-label-success me-1">Non Pris</span></td>
                            @endif


                            <td>{{ $badge->type->name }}</td>
                            <td class="action">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modifier-{{ $badge->id }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="/deleteBadge/{{ $badge->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>

                            @include('content.modals.editBadge', ['badge' => $badge],['types' => $types])

                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>

@endsection
