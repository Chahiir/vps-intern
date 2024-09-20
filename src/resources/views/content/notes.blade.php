@extends('layouts/contentNavbarLayout')

@section('title', 'Evaluations ')



@section('content')



    <button class="btn btn-primary me-1 float-end" type="button" data-bs-toggle="collapse" data-bs-target="#data-table_filter"
        aria-expanded="false" aria-controls="data-table_filter">
        <i class='bx bx-search-alt-2'></i>
    </button>

    <br>
    <br>
    <div class="p-2 card">


        <div class="table-responsive text-nowrap" id="print-section">
            <img src="{{ asset('assets/img/print/Picture1.jpg') }}" style="display:none;margin:auto;"
                class="print-header"><br>
            <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Liste des Evaluations</h3>
            </div>
            <br>
            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Salarier</th>
                        <th>Manager</th>
                        <th>Note Final</th>
                        <th>Annee</th>
                        <th>Points Fort</th>
                        <th>Points à améliorer
                        </th>
                        <th>Projet professionnel et perspectives
                        </th>
                        <th>Actions pour la période à venir
                        </th>
                        <th>Commentaires
                        </th>
                        <th class="action">Action</th>

                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @foreach ($remarques as $remarque)
                        <tr>

                            <td class="action">
                              @can('show-note')
                                <a class="dropdown-item" href='{{ url("show-note/$remarque->id") }}'>
                                    <i class='bx bx-plus-circle'></i>
                                </a>
                              @endcan
                            </td>
                            <td> <span
                                    class="fw-medium">{{ $remarque->salarie->nom }}&nbsp;{{ $remarque->salarie->prenom }}</span>
                            </td>
                            <td>{{ $remarque->salarie->manager->nom }}&nbsp;{{ $remarque->salarie->manager->prenom }}</td>
                            <td>{{ $remarque->note_final }}</td>
                            <td>{{ $remarque->annee }}</td>
                            <td>{{ $remarque->point_fort }}</td>
                            <td>{{ $remarque->point_ameliorer }}</td>
                            <td>{{ $remarque->projet }}</td>
                            <td>{{ $remarque->action }}</td>
                            <td>{{ $remarque->commentaire }}</td>
                            <td class="action">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                      @can('download-note')
                                        @php
                                            $fileName = $remarque->salarie->nom.'-'.$remarque->salarie->prenom.'-'.$remarque->annee.'.pdf';
                                        @endphp
                                        <a href="{{ Route('download.pdf',$fileName) }}" class="dropdown-item">
                                            <i class='bx bx-download'></i>
                                            Telecharger
                                        </a>
                                        @endcan
                                        @can('edit-note')
                                        <a class="dropdown-item" href="/edit-note/{{ $remarque->id }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        @endcan
                                        @can('delete-note')
                                        <form action="/delete-note/{{ $remarque->id }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>




                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
