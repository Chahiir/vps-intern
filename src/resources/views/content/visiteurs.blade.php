@extends('layouts/contentNavbarLayout')

@section('title', 'Visiteurs')


@section('content')



    <button class="btn btn-primary me-1 float-end" type="button" data-bs-toggle="collapse" data-bs-target="#data-table_filter"
        aria-expanded="false" aria-controls="data-table_filter">
        <i class='bx bx-search-alt-2'></i>
    </button>
    <div class="btn-group me-3 float-end">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="bx bxs-download me-1"></i> Exporter
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonIcon">
            <li><button class="dropdown-item d-flex align-items-center" onclick="printTable()"><i
                        class="bx bx-printer scaleX-n1-rtl"></i> Imprimer</button></li>
            <li><button class="dropdown-item d-flex align-items-center" onclick="downloadCSV('visiteurs')"><i
                        class="bx bx-download scaleX-n1-rtl"></i> CSV</button></li>
            <li><button class="dropdown-item d-flex align-items-center" onclick="downloadExcel('visiteurs')"><i
                        class="bx bx-download scaleX-n1-rtl"></i> Excel</button></li>
        </ul>
    </div>
    <br><br>
    <br>
    <div class="card">

        <div class="table-responsive text-nowrap" id="print-section">

            <img src="{{ asset('assets/img/print/Picture1.jpg') }}" style="display:none;margin:auto;"
                class="print-header"><br>
            <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Liste des Visiteurs</h3>
            </div>
            <table class="table table-striped" id="data-table">
                <thead>

                    <tr>
                        <th>Nom</th>
                        <th>CIN</th>
                        <th>Entreprise</th>
                        <th>Motif de visite</th>
                        <th>Badge</th>
                        <th>Entrer</th>
                        <th>Sortie</th>
                        <th>Statut</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($visiteurs as $visiteur)
                        <tr>
                            <td> <span class="fw-medium">{{ \App\Helpers\SalarierHelper::toMaj($visiteur->nom) }}&nbsp;{{ \App\Helpers\SalarierHelper::firstMaj($visiteur->prenom) }}</span></td>
                            <td>{{ \App\Helpers\SalarierHelper::toMaj($visiteur->cin) }}</td>
                            <td>{{ \App\Helpers\SalarierHelper::toMaj($visiteur->entreprise) }}</td>
                            <td>{{ $visiteur->motif }}</td>
                            <td>{{ \App\Helpers\SalarierHelper::toMaj($visiteur->badge->reference) }}</td>
                            <td>{{ $visiteur->entrer }}</td>
                            <td>{{ $visiteur->sortie }}</td>
                            @if ($visiteur->sortie)
                                <td><span class="badge bg-label-success"> Sorti </span></td>
                            @else
                                <td><span class="badge bg-label-warning"> dans le bureau </span></td>
                            @endif
                            <td class="action">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                      @can('retour-badge')
                                        @if (!isset($visiteur->sortie))
                                            <form action="/retour-badge/{{ $visiteur->id }}" method="POST">
                                                @csrf
                                                <button class="dropdown-item" type="submit"><i
                                                        class="bx bx-lock-alt me-1"></i>
                                                    Retour
                                                </button>
                                            </form>
                                        @endif
                                      @endcan
                                      @can('edit-visit')
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modifier-{{ $visiteur->id }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                                @endcan
                                                @can('delete-visit')
                                        <form action="/delete-visiteur/{{ $visiteur->id }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                            @can('edit-visit')
                            @include('content.modals.editVisiteur', ['visiteur' => $visiteur])
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
