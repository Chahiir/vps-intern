@extends('layouts/contentNavbarLayout')

@section('title', 'Users')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/mine.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/mine.js') }}"></script>

@endsection

@section('content')
<div class="container">
  <button type="button" class="btn btn-primary col-3 mb-4 float-start" data-bs-toggle="modal" data-bs-target="#ajouter">
    Ajouter un Utilisateur
  </button>

@include('content.modals.addUser',['roles'=>$roles])
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            @include('content.modals.editUser',['user'=>$user],['roles'=>$roles])
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge rouded-pill bg-label-info">{{ $user->role->name ?? 'No Role' }}</span>
                </td>
                <td>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#edit-{{ $user->id }}">Edit</button>
                    <form action="/delete-user/{{ $user->id }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
