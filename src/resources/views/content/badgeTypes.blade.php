@extends('layouts/contentNavbarLayout')

@section('title', 'Badge Types ')





@section('content')
    @can('add-type-badge')
    <button type="button" class="btn btn-primary col-3 mb-4 float-start" data-bs-toggle="modal" data-bs-target="#ajouter">
        Ajouter un type de Badge
    </button>
    @endcan
    <br><br><br>
    <div class="card p-2">

        <div class="card-header d-flex align-items-center justify-content-between position-relative ">
            <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Liste des types de badges</h3>
        </div>
        <br>
        @can('add-type-badge')
        <div class="modal fade" id="ajouter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <div
                                    class="card-header d-flex align-items-center justify-content-between position-relative ">
                                    <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Ajouter un type
                                    </h3>
                                </div>
                                <br>
                                <div class="card-body">
                                    <form method="POST" action="/add-badge-type">
                                        @csrf
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nom de
                                                type</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="basic-default-name"
                                                    placeholder="Nom" name="name" required/>
                                            </div>
                                        </div>


                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary float-end">Ajouter</button>
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
        @endcan
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom de type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @foreach ($types as $type)
                        <tr>
                            <td> <span class="fw-medium">{{ \App\Helpers\SalarierHelper::firstMaj($type->name) }}</span></td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                      @can('edit-type-badge')
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modifier-{{ $type->id }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                                @endcan
                                                @can('delete-type-badge')
                                        <form action="/delete-badge-type/{{ $type->id }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                            @can('edit-type-badge')
                            <div class="modal fade" id="modifier-{{ $type->id }}" tabindex="-1"
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
                                                        class="card-header d-flex align-items-center justify-content-between position-relative ">
                                                        <h3
                                                            class="mb-8 position-absolute top-100 start-50 translate-middle">
                                                            Modifier le type</h3>
                                                    </div>
                                                    <br>
                                                    <div class="card-body">
                                                        <form method="POST" action="edit-badge-type/{{ $type->id }}">
                                                            @csrf
                                                            <div class="row mb-3">
                                                                <label class="col-sm-2 col-form-label"
                                                                    for="basic-default-name">Nom du Type <br> badge</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        id="basic-default-name" placeholder="Nom"
                                                                        name="name" value="{{ $type->name }}" required/>
                                                                </div>
                                                            </div>


                                                            <div class="row justify-content-end">
                                                                <div class="col-sm-10">
                                                                    <button type="submit"
                                                                        class="btn btn-primary float-end">Modifier</button>
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
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
