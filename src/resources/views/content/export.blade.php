@extends('layouts/contentNavbarLayout')

@section('title', 'Rapports ')


@section('content')

    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills" style="margin-left: 40%" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-within-card-active" role="tab">Excel</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-within-card-link" role="tab">CSV</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content p-0">
                <div class="tab-pane fade show active" id="navs-pills-within-card-active" role="tabpanel">
                    <form action="{{ url('/exportExcel') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label"> Exportation Excel</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="data"
                                aria-label="Default select example" required>
                                <option selected disabled></option>
                                <option value="1">Salaries</option>
                                <option value="2">Partenaires</option>
                                <option value="3">Visiteurs</option>
                                <option value="4">Visites Partenaire</option>
                                <option value="5">Badges</option>
                                <option value="6">Utilisateurs</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary">Export</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="navs-pills-within-card-link" role="tabpanel">
                    <form action="{{ url('/exportCSV') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label"> Exportation CSV</label>
                            <select class="form-select" id="exampleFormControlSelect1" name="data"
                                aria-label="Default select example" required>
                                <option selected disabled></option>
                                <option value="1">Salaries</option>
                                <option value="2">Partenaires</option>
                                <option value="3">Visiteurs</option>
                                <option value="4">Visites Partenaire</option>
                                <option value="5">Badges</option>
                                <option value="6">Utilisateurs</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary">Export</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
