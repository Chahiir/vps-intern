@extends('layouts/contentNavbarLayout')

@section('title', 'Evaluation')

@section('content')


        <div class="card text-center">
            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="navs-pills-within-card-active" role="tabpanel">
                        <form action="{{ url('/fiche-evaluation') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label"> Salarier evaluer</label>
                                <select class="form-select" id="exampleFormControlSelect1" name="salarie_id"
                                    aria-label="Default select example">
                                    <option selected disabled>Salariers</option>
                                        @foreach ($salaries as $salarie)
                                            <option value="{{ $salarie->id }}"> {{ $salarie->nom }} &nbsp; {{ $salarie->prenom }} </option>
                                        @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Evaluer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


@endsection
