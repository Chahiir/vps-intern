@extends('layouts/contentNavbarLayout')

@section('title', 'Roles')



@section('content')
@can('add-role')
    <button type="button" class="btn btn-primary col-3 mb-4 float-start" data-bs-toggle="modal" data-bs-target="#ajouter">
        Ajouter un role
    </button>
    @include('content.modals.addRole', ['permissions' => $permissions])
    @endcan
    <br>
    <br>
    <br>
    <div class="card">
        <div class="table-responsive text-nowrap" id="print-section">
            <br>
            <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Liste des Role</h3>
            </div>
            <table class="table table-striped" id="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th style="width: 80%;">Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($roles as $role)
                    @can('edit-role')
                        @include(
                            'content.modals.editRole',
                            ['permissions' => $permissions],
                            ['role' => $role]
                        )
                    @endcan
                        <tr>
                            <td>{{ \App\Helpers\SalarierHelper::toMaj($role->name) }}</td>
                            <td  style="width: 80%; max-height: 150px; overflow-y: auto;">
                              <div style="display: flex; flex-wrap: wrap; gap: 4px;">

                                @foreach ($role->permissions as $permission)
                                    <span class="badge rounded-pill bg-label-info" style="margin-bottom: 4px;">{{ \App\Helpers\SalarierHelper::toMaj($permission->name) }}</span>
                                @endforeach
                              </div>
                            </td>
                            <td class="action">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                      @can('edit-role')
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#edit-{{ $role->id }}"><i class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                            @endcan
                                            @can('delete-role')
                                        <form action="/delete-role/{{ $role->id }}" method="POST" class="delete-form">
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
