@extends('layouts/contentNavbarLayout')

@section('title', 'Permissions')



@section('content')
@can('add-permission')
    <button type="button" class="btn btn-primary col-3 mb-4 float-start" data-bs-toggle="modal" data-bs-target="#ajouter">
        Ajouter une permission
    </button>
    @include('content.modals.addPermission')
    @endcan
    <button class="btn btn-primary me-1 float-end" type="button" data-bs-toggle="collapse" data-bs-target="#data-table_filter"
        aria-expanded="false" aria-controls="data-table_filter">
        <i class='bx bx-search-alt-2'></i>
    </button>
    <br>
    <br>
    <br>
    <div class="card">
        <div class="table-responsive text-nowrap" id="print-section">
            <br>
            <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Liste des Permissions</h3>
            </div>
            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($permissions as $permission)
                    @can('edit-permission')
                        @include('content.modals.editPermission', ['permission' => $permission])
                        @endcan
                        <tr>
                            <td>{{ \App\Helpers\SalarierHelper::toMaj($permission->name) }}</td>

                            <td class="action">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                      @can('edit-permission')
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#edit-{{ $permission->id }}"><i class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                            @endcan
                                            @can('delete-permission')
                                        <form action="/delete-permission/{{ $permission->id }}" method="POST" class="delete-form">
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
