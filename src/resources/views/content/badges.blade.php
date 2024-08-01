@extends('layouts/contentNavbarLayout')

@section('title', 'Badges')



@section('content')

    <button class="btn btn-primary me-1 float-end" type="button" data-bs-toggle="collapse" data-bs-target="#data-table_filter"
        aria-expanded="false" aria-controls="data-table_filter">
        <i class='bx bx-search-alt-2'></i>
    </button>
    <div class="btn-group me-3 mb-3 float-end mx-auto">

        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="bx bxs-download me-1"></i> Exporter
        </button>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonIcon">
            <li><button class="dropdown-item d-flex align-items-center" onclick="printTable()"><i
                        class="bx bx-printer scaleX-n1-rtl"></i> Imprimer</button></li>
            <li><button class="dropdown-item d-flex align-items-center" onclick="downloadCSV('badges')"><i
                        class="bx bx-download scaleX-n1-rtl"></i> CSV</button></li>
            <li><button class="dropdown-item d-flex align-items-center" onclick="downloadExcel('badges')"><i
                        class="bx bx-download scaleX-n1-rtl"></i> Excel</button></li>
        </ul>
    </div>
    @can('add-badge')
    <button type="button" class="btn btn-primary col-3 mb-4 float-start" data-bs-toggle="modal" data-bs-target="#ajouter">
        Ajouter un Badge
    </button>
    @include('content.modals.addBadge', ['types' => $types])

    @endcan
    <br><br>

    <br>
    <div class="card">



        <div class="table-responsive text-nowrap" id="print-section">
            <img src="{{ asset('assets/img/print/Picture1.jpg') }}" style="display:none;margin:auto;"
                class="print-header"><br>
            <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Liste des Badges</h3>
            </div>
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
                            <td> <span class="fw-medium">{{ \App\Helpers\SalarierHelper::toMaj($badge->reference) }}</span></td>
                            @if ($badge->taken)
                                <td><span class="badge bg-label-warning me-1">Pris</span></td>
                            @else
                                <td><span class="badge bg-label-success me-1">Non Pris</span></td>
                            @endif


                            <td>{{ \App\Helpers\SalarierHelper::firstMaj($badge->type->name) }}</td>
                            <td class="action">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                      @can('edit-badge')
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modifier-{{ $badge->id }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                                @endcan
                                                @can('delete-badge')
                                        <form action="/delete-badge/{{ $badge->id }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                            @can('edit-badge')
                            @include('content.modals.editBadge', ['badge' => $badge], ['types' => $types])
                            @endcan
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>

@endsection
