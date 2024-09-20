@extends('layouts/contentNavbarLayout')

@section('title', 'Salaries')

@section('content')
    @can('add-salarie')
    <a class="btn btn-primary col-3 mb-4 float-start" href="{{ url('/add-salarie') }}">
        Ajouter un salarie
    </a>
    @endcan
    <button class="btn btn-primary me-1 float-end" type="button" data-bs-toggle="collapse" data-bs-target="#data-table_filter"
        aria-expanded="false" aria-controls="data-table_filter">
        <i class='bx bx-search-alt-2'></i>
    </button>
    <div class="btn-group me-3 float-end">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonIcon"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bxs-download me-1"></i> Exporter
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonIcon">
            <li><button class="dropdown-item d-flex align-items-center" onclick="printTable()"><i
                        class="bx bx-printer scaleX-n1-rtl"></i> Imprimer</button></li>
            <li><button class="dropdown-item d-flex align-items-center" onclick="downloadCSV('salaries')"><i
                        class="bx bx-download scaleX-n1-rtl"></i> CSV</button></li>
            <li><button class="dropdown-item d-flex align-items-center" onclick="downloadExcel('salaries')"><i
                        class="bx bx-download scaleX-n1-rtl"></i> Excel</button></li>
        </ul>
    </div>
    <br>
    <br><br>
    <br>
    <div class="p-2 card">
        <div class="table-responsive text-nowrap" id="print-section">
            <img src="{{ asset('assets/img/print/Picture1.jpg') }}" style="display:none;margin:auto;"
                class="print-header"><br>
            <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Liste des Salariers</h3>
            </div>
            <table class="table table-striped" id="data-table">
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
                              @can('show-salarie')
                                <a class="dropdown-item" href='{{ url("show-salarie/$salarie->id") }}'>
                                    <i class='bx bx-plus-circle'></i>
                                </a>
                                @endcan
                            </td>
                            <td> <span class="fw-medium">{{ \App\Helpers\SalarierHelper::toMaj($salarie->nom) }}&nbsp;{{ \App\Helpers\SalarierHelper::firstMaj($salarie->prenom) }}</span></td>
                            <th>{{ $salarie->badge->reference ?? '' }}</th>
                            <td>{{ \App\Helpers\SalarierHelper::toMaj($salarie->cin) }}</td>
                            <td>{{ $salarie->type->name }}</td>
                            @if ($salarie->active)
                                <td><span class="badge bg-label-success">Active</span></td>
                            @else
                                <td><span class="badge bg-label-warning">Inactive</span></td>
                            @endif
                            <td class="action">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">

                                        @if ($salarie->active)
                                        @can('desactive-salarie')
                                    <button class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#disable-{{ $salarie->id }}"><i
                                      class="bx bx-lock-alt me-1"></i>
                                  Desactiver le salarié</button>
                                  @endcan
                                        @else
                                        @can('active-salarie')
                                            <form action="/reactive-salarie/{{ $salarie->id }}" method="POST">
                                                @csrf
                                                <button class="dropdown-item" type="submit"><i
                                                        class="bx bx-lock-open-alt me-1"></i>
                                                    Activer le salarié</button>
                                            </form>
                                            @endcan
                                        @endif
                                        @can('edit-salarie')
                                        <a class="dropdown-item" href='{{ url("/edit-salarie/$salarie->id") }}'><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                          @endcan
                                          @can('delete-salarie')
                                        <form action="/delete-salarie/{{ $salarie->id }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>

                            @include('content.modals.disableSalarie', ['salarie' => $salarie])
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    @endsection
