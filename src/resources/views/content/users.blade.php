@extends('layouts/contentNavbarLayout')

@section('title', 'Users')



@section('content')
@can('add-user')
    <button type="button" class="btn btn-primary col-3 mb-4 float-start" data-bs-toggle="modal" data-bs-target="#addUser">
        Ajouter un Utilisateur
    </button>
    @include('content.modals.addUser', ['roles' => $roles])
    @endcan
    <br><br><br>
    <div class="card p-2">
        <div class="table-responsive text-nowrap" id="print-section">
            <img src="{{ asset('assets/img/print/Picture1.jpg') }}" style="display:none;margin:auto;" class="print-header"><br>
            <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Liste des Utilisateurs</h3>
            </div>
            <table class="table table-striped " id="data-table">
                <thead>
                    <tr>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Dernière Connexion</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                    @can('edit-user')
                        @include('content.modals.editUser', ['user' => $user], ['roles' => $roles])
                        @endcan
                        <tr>

                            <td>{{ \App\Helpers\SalarierHelper::toMaj($user->salarier->nom) }} &nbsp; {{ \App\Helpers\SalarierHelper::firstMaj($user->salarier->prenom) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>

                                <span class="badge rouded-pill bg-label-info">{{ $user->role->name ?? 'No Role' }}</span>
                            </td>
                            <td>{{ $user->last_loggin ?? 'Jamais' }}</td>
                            <td class="action">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                      @can('edit-user')
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#editUser-{{ $user->id }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                            @endcan
                                            @can('delete-user')
                                        <form action="/delete-user/{{ $user->id }}" method="POST" class="delete-form">
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
    </div>
    
@endsection
