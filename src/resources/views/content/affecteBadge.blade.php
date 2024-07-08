@extends('layouts/contentNavbarLayout')

@section('title', 'Affecte Badges')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Affecter un badge pour un salarier</h5> <small
                                class="text-muted float-end"></small>
                        </div>
                        <div class="card-body">
                            <form action="/affecteBadge" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">Type de
                                        contrat</label>
                                    <div class="col-sm-10">
                                        <select id="type_contrat" name="type_contrat" class="form-select col-sm-10">
                                            <option disabled selected>Contrat</option>
                                            <option value="employer">Employer</option>
                                            <option value="stagaire">Stagaire</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="display:none" id="select-container">
                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">Employe</label>
                                        <div class="col-sm-10">
                                            <select name="employe" id="employe" class="form-select col-sm-10">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 form-label" for="basic-icon-default-phone">Badge</label>
                                        <div class="col-sm-10">
                                            <select id="badge" name="badge" class="form-select col-sm-10">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeContrat = document.getElementById('type_contrat');
            const selectContainer = document.getElementById('select-container');
            const selectEmploye = document.getElementById('employe');
            const selectBadge = document.getElementById('badge');

            typeContrat.addEventListener('change', function() {
                const selectedValue = this.value;

                // Show the second select
                selectContainer.style.display = 'block';

                // Fetch data based on selected value
                fetch(`/getData?type=${selectedValue}`)
                    .then(response => response.json())
                    .then(data => {
                        // Clear the current options
                        selectEmploye.innerHTML = '';
                        selectBadge.innerHTML = '';

                        // Populate the employee select with new options
                        data.employees.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item.nom + ' ' + item
                            .prenom; // Adjust according to your data structure
                            selectEmploye.appendChild(option);
                        });

                        // Populate the badge select with new options
                        data.badges.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item
                            .reference; // Adjust according to your data structure
                            selectBadge.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching data:', error));
            });
        });
    </script>
@endsection
