@extends('layouts/contentNavbarLayout')

@section('title', 'Documents')





@section('content')
    @can('add-type-document')
    <button type="button" class="btn btn-primary col-3 mb-4 float-start" data-bs-toggle="modal" data-bs-target="#ajouter">
        Ajouter un Document
    </button>
    @endcan
    <br><br><br>
    <div class="card">

        <div class="card-header d-flex align-items-center justify-content-between position-relative ">
            <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Liste des Documents</h3>
        </div>
        <br>
        @can('add-type-document')
        <div class="modal fade" id="ajouter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <div
                                    class="card-header d-flex align-items-center justify-content-between position-relative ">
                                    <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Ajouter un Document
                                    </h3>
                                </div>
                                <br>
                                <div class="card-body">
                                    <form method="POST" action="/add-document">
                                        @csrf
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nom du document
                                                </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="basic-default-name"
                                                    placeholder="Nom" name="name" required/>
                                            </div>
                                        </div>

                                      <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-email">Type Contrat</label>
                                        <div class="col-sm-10">
                                          <select name="contratTypes[]" id="services" class="select2 form-control"
                                          multiple="multiple">
                                          @foreach ($contratTypes as $type)
                                              <option value="{{ $type->id }}">{{ $type->name }}</option>
                                          @endforeach
                                      </select>
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
            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>Nom du Document</th>
                        <th>Contrats</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @foreach ($documents as $document)
                        <tr>
                            <td> <span class="fw-medium">{{ $document->name }}</span></td>
                            <td>
                              @foreach ($document->contratTypes as $type)
                                    <span class="badge rouded-pill bg-label-info">{{ $type->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                      @can('edit-type-document')
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modifier-{{ $document->id }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                      @endcan
                                      @can('delete-type-document')
                                        <form action="/delete-document/{{ $document->id }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                            @can('edit-type-document')
                            <div class="modal fade" id="modifier-{{ $document->id }}" tabindex="-1"
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
                                                            Modifier le document</h3>
                                                    </div>
                                                    <br>
                                                    <div class="card-body">
                                                        <form method="POST" action="edit-document/{{ $document->id }}">
                                                            @csrf
                                                            <div class="row mb-3">
                                                                <label class="col-sm-2 col-form-label"
                                                                    for="basic-default-name">Nom du<br> Document</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        id="basic-default-name" placeholder="Nom"
                                                                        name="name" value='{{ $document->name }}' required/>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                              <label for="permissions" class="col-sm-2 form-label">Contrats</label> <br>
                                                              <select class="select2 form-control" id="" name="contratTypes[]"
                                                                  multiple="multiple">
                                                                  @foreach ($contratTypes as $type)
                                                                      <option value="{{ $type->id }}"
                                                                          @if ($document->contratTypes->contains($type->id)) selected @endif>
                                                                          {{ $type->name }}
                                                                      </option>
                                                                  @endforeach
                                                              </select>
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
