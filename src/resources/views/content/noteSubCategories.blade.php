@extends('layouts/contentNavbarLayout')

@section('title', 'Note Sub-Categories ')



@section('content')
    @can('add-sous-categorie-note')
    <button type="button" class="btn btn-primary col-3 mb-4 float-start" data-bs-toggle="modal" data-bs-target="#ajouter">
        Ajouter une sous categorie de note
    </button>
    @endcan
    <br><br><br>
    <div class="card">

        <div class="card-header d-flex align-items-center justify-content-between position-relative ">
            <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Liste des sous-categories de note</h3>
        </div>
        <br>
        @can('add-sous-categorie-note')
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
                                    <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Ajouter une sous categorie
                                    </h3>
                                </div>
                                <br>
                                <div class="card-body">
                                    <form method="POST" action="/add-note-sub-categorie">
                                        @csrf
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nom du categorie
                                                </label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="basic-default-name"
                                                    placeholder="Nom" name="name" required/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                          <label class="col-sm-2 col-form-label" for="basic-default-email">Categorie</label>
                                          <div class="col-sm-10">
                                              <select id="defaultSelect" class="form-select " name="note_categorie_id">
                                                  <option value="" selected disabled>Categories</option>
                                                  @foreach ($categories as $categorie)
                                                      <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                                  @endforeach

                                              </select>
                                          </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-email">Service</label>
                                        <div class="col-sm-10">
                                          <select name="services[]" id="services" class="select2 form-control"
                                          multiple="multiple">
                                          @foreach ($services as $service)
                                              <option value="{{ $service->id }}">{{ $service->name }}</option>
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
                        <th>Nom du Sous Categorie</th>
                        <th>Categorie</th>
                        <th>Services</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @foreach ($subCategories as $subCategorie)
                        <tr>
                            <td> <span class="fw-medium">{{ $subCategorie->name }}</span></td>
                            <td><span class="fw-medium">{{ $subCategorie->categorie->name }}</span></td>
                            <td>
                              @foreach ($subCategorie->services as $service)
                                    <span class="badge rouded-pill bg-label-info">{{ $service->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                      @can('edit-sous-categorie-note')
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modifier-{{ $subCategorie->id }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                                @endcan
                                                @can('delete-sous-categorie-note')
                                        <form action="/delete-note-sub-categorie/{{ $subCategorie->id }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                            @can('edit-sous-categorie-note')
                            <div class="modal fade" id="modifier-{{ $subCategorie->id }}" tabindex="-1"
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
                                                            Modifier la sous Categorie</h3>
                                                    </div>
                                                    <br>
                                                    <div class="card-body">
                                                        <form method="POST" action="edit-note-sub-categorie/{{ $subCategorie->id }}">
                                                            @csrf
                                                            <div class="row mb-3">
                                                                <label class="col-sm-2 col-form-label"
                                                                    for="basic-default-name">Nom du sous<br> Categorie</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        id="basic-default-name" placeholder="Nom"
                                                                        name="name" value='{{ $subCategorie->name }}' required/>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                              <label for="permissions" class="col-sm-2 form-label">Services</label> <br>
                                                              <select class="select2 form-control" id="" name="services[]"
                                                                  multiple="multiple">
                                                                  @foreach ($services as $service)
                                                                      <option value="{{ $service->id }}"
                                                                          @if ($subCategorie->services->contains($service->id)) selected @endif>
                                                                          {{ $service->name }}
                                                                      </option>
                                                                  @endforeach
                                                              </select>
                                                          </div>
                                                            <div class="row mb-3">
                                                              <label class="col-sm-2 col-form-label" for="basic-default-email">Categorie</label>
                                                              <div class="col-sm-10">
                                                                  <select id="defaultSelect" class="form-select " name="note_categorie_id">
                                                                      @foreach ($categories as $categorie)
                                                                          <option value="{{ $categorie->id }}" @if($categorie->id == $subCategorie->note_categorie_id) selected @endif>{{ $categorie->name }}</option>
                                                                      @endforeach
                                                                  </select>
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
