@extends('layouts/contentNavbarLayout')

@section('title', 'Afficher Salarie')

@section('content')

    <style>
        .employee-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .employee-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .employee-name {
            font-size: 24px;
            font-weight: bold;
            color: #3498db;
        }

        .employee-id {
            font-size: 14px;
            color: #7f8c8d;
        }

        .info-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-item {
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: bold;
            color: #2c3e50;
        }

        .info-value {
            color: #34495e;
        }

        .contract-info {
            background-color: #ecf0f1;
            border-radius: 4px;
            padding: 10px;
            margin-top: 15px;
        }

        .contract-title {
            font-weight: bold;
            color: #16a085;
            margin-bottom: 5px;
        }
    </style>

    <h1 class="text-center"> Information du Salarie</h1>

    <div class="employee-card">
        <div class="employee-header">
            <span class="employee-name">{{ $salarie->nom }}, {{ $salarie->prenom }}</span>
            <div class="float-end">
              @can('logs-salarie')
            <a href="/logs/{{ $salarie->id }}" class="btn btn-outline-info ">Logs</a>
            @endcan
            <a href="/salaries" class="btn btn-outline-danger ">X</a>
          </div>
        </div>

        <div class="info-group">
            <div class="info-item">
                <span class="info-label">Nom:</span>
                <span class="info-value">{{ \App\Helpers\SalarierHelper::toMaj($salarie->nom) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Prénom:</span>
                <span class="info-value">{{ \App\Helpers\SalarierHelper::firstMaj($salarie->prenom) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Date de Naissance:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($salarie->date_naissance)->format('d/m/Y') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Age:</span>
                <span class="info-value">
                  @php
                  $currentYear = now()->year;
                  $birthDate = \Carbon\Carbon::parse($salarie->date_naissance);
                  $birthYear = $birthDate->year;

                  echo  $currentYear - $birthYear;

                  @endphp
                  ans
                </span>
            </div>
            <div class="info-item">
                <span class="info-label">Adresse:</span>
                <span class="info-value">{{ $salarie->adresse }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Sexe:</span>
                <span class="info-value">{{ \App\Helpers\SalarierHelper::gender($salarie->sexe) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Situation Familiale:</span>
                <span class="info-value">
                    {{ \App\Helpers\SalarierHelper::formatSituationFamiliale($salarie->situation_familiale) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Enfant en charge:</span>
                <span class="info-value">{{ $salarie->n_enfant_charge }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">CIN:</span>
                <span class="info-value">{{ \App\Helpers\SalarierHelper::toMaj($salarie->cin) }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Expiration CIN:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($salarie->date_exp_cin)->format('d/m/Y') }}</span>
            </div>


            <div class="info-item">
                <span class="info-label">Numero CNSS:</span>
                <span class="info-value">{{ $salarie->cnss ?? ''}}</span>
            </div>

            <div class="info-item">
              <span class="info-label">Numero CIMR:</span>
              <span class="info-value">{{ $salarie->cimr ?? ''}}</span>
          </div>

            <div class="info-item">
                <span class="info-label"> Numero d'assurance:</span>
                <span class="info-value">{{ $salarie->n_assurer ?? ''}}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Expiration RMA:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($salarie->date_exp_rma)->format('d/m/Y') ?? '' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Seniority:</span>
                <span class="info-value">
                    {{ \App\Helpers\SalarierHelper::seniority($salarie->date_debut) }}

                  </span>
            </div>
            <div class="info-item">
                <span class="info-label">Fonction:</span>
                <span class="info-value">{{ $salarie->fonction }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Service:</span>
                <span class="info-value">{{ $salarie->service->name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Categorie:</span>
                <span class="info-value">{{ $salarie->categorie }}</span>
            </div>
            <div class="info-item">
              <span class="info-label"> Nature de depart:</span>
              <span class="info-value">{{ $salarie->nature_depart ?? 'N/A' }}</span>
          </div>
            <div class="info-item">
                <span class="info-label">Phone:</span>
                <span class="info-value">{{ $salarie->phone }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">PUK:</span>
                <span class="info-value">{{ $salarie->puk ?? 'N/A' }}</span>
            </div>





        </div>

        <div class="contract-info">
            <div class="contract-title">Contrat Information</div>
            <div class="info-item">
                <span class="info-label">Contrat Type:</span>
                <span class="info-value">{{ $salarie->type->name }}</span>
            </div>
            <div class="info-item">
                <span class="info-label"> Date debut:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($salarie->date_debut)->format('d/m/Y') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label"> Date fin:</span>
                <span
                    class="info-value">{{ $salarie->date_fin ? \Carbon\Carbon::parse($salarie->date_fin)->format('d/m/Y') : 'N/A' }}</span>
            </div>
        </div>
        <div class="info-group m-4" >
          <h5>Documents Telecharger :</h5> <br>



                        @foreach($documents as $document)
                              @if($salarie->documents->contains($document->id))
                              <div class="info-item">
                              <p> <label class="info-label">
                                <a href="{{ route('documents.download', ['path' => urlencode(str_replace('public/', '', $salarie->documents->find($document->id)->pivot->file_path))]) }}" >
                                    {{ $document->name }}
                                </a>

                          </label>
                              </p>
                            </div>
                              @endif
                              @endforeach


        </div>

        <div class="contract-info">
          <div class="contract-title">Contacts d'urgence</div>
          @foreach($contactUrgences as $index => $contact)
              <div class="info-item">
                  <span class="info-label">Nom Contact:</span>
                  <span class="info-value">{{ \App\Helpers\SalarierHelper::toMaj($contact->nom_contact) }}</span>
              </div>
              <div class="info-item">
                  <span class="info-label">Telephone:</span>
                  <span class="info-value">{{ $contact->phone_contact }}</span>
              </div>
              <div class="info-item">
                  <span class="info-label">Relation:</span>
                  <span class="info-value">{{ $contact->lien_familiale }}</span>
              </div>
              @if($index < count($contactUrgences) - 1)
                  <hr style="border: 1px gray solid"> <!-- Horizontal line to act as a separator -->
              @endif
          @endforeach
      </div>
    </div>


@endsection
