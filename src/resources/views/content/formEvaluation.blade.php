@extends('layouts/contentNavbarLayout')

@section('title', 'Rapports ')


@section('content')
    <div class="container">
        <h1>Evaluation de {{ $salarie->nom }} &nbsp; {{ $salarie->prenom }}</h1>
        <form id="multiStepForm" data-parsley-validate>
            @csrf
            <input type="hidden" name="salarie_id" value="{{ $salarie->id }}" id="">
            <div class="step-pane active" id="step1" data-parsley-group="block-1">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th class="fs-big" style="width: 32%;"></th>
                            <th class="fs-big " style="width: 10%;">Note sur 5</th>
                            <th class="fs-big" style="width: 15%;">Appréciation </th>
                            <th class="fs-big" style="width: 43%;">Remarques </th>
                        </tr>
                    </thead>
                </table>
            </div>

            @foreach ($groupedSubCategories as $categorieId => $subCategories)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th class="fs-large invert-text-dark">{{ $subCategories->first()->categorie->name }}
                                        </th>
                                    </tr>
                                </thead>
                                @foreach ($subCategories as $subCategorie)
                                    <tbody>
                                        <tr>
                                            <td style="width: 30%;">{{ $subCategorie->name }}</td>
                                            <td style="width: 10%;">
                                              <select name="note[]"
                                              class="form-control @error('note') is-invalid @enderror" required
                                              data-category="{{ $subCategorie->note_categorie_id }}"
                                              data-parsley-group="block-1"
                                              id="note-{{ $subCategorie->id }}" onchange="handleNoteChange({{ $subCategorie->note_categorie_id }},{{ $subCategorie->id }})">
                                              <option value="" selected disabled>Note</option>
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                            </select>
                                              {{-- <input
                                                    onchange="handleNoteChange({{ $subCategorie->note_categorie_id }},{{ $subCategorie->id }})"
                                                    type="number" id="note-{{ $subCategorie->id }}" name="note[]"
                                                    placeholder="Note" value="{{ old('note[]') }}"
                                                    class="form-control @error('note') is-invalid @enderror" required
                                                    data-parsley-type="integer" data-parsley-required
                                                    data-parsley-range="[1, 5]"
                                                    data-category="{{ $subCategorie->note_categorie_id }}"
                                                    data-parsley-group="block-1"
                                                    > --}}
                                            </td>
                                            <td style="width: 15%;"><input value="" type="text" name="appreciation"
                                                    placeholder="Appreciation" aria-label="First name"
                                                    style="color:black !important"
                                                    id="appreciation-{{ $subCategorie->id }}"
                                                    class="form-control @error('nom') is-invalid @enderror" disabled></td>
                                            <td style="width: 45%;">
                                                <input value="{{ old('remarque[]') }}" type="text" name="remarque[]"
                                                    placeholder="Remarque" aria-label="Last name"
                                                    class="form-control @error('prenom') is-invalid @enderror"
                                                    data-parsley-maxlength="255" data-parsley-required="false">
                                            </td>
                                        </tr>
                                    </tbody>
                                    <input type="hidden" value="{{ $subCategorie->id }}" name="note_sub_categorie_id[]">
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="row mb-3 float-center" style="margin-left: 15px">
                        <label class="col-sm-4 col-form-label fs-large"> Note
                            {{ $subCategories->first()->categorie->name }}</label>
                        <div class="col-sm-4 mt-2">
                            <input type="text" id="average-note-{{ $subCategorie->note_categorie_id }}"
                                class="form-control" disabled>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row mb-3 float-center text-center" style="margin: auto">
              <label class="col-sm-4 col-form-label fs-large"> Note
                  Finale</label>
              <div class="col-sm-4 ">
                  <input type="text" id="finale-note"
                      class="form-control" disabled>
              </div>
              <input type="hidden" name="note_final" id="note_final" value="">
          </div>

            <a class="btn btn-primary float-end next-btn" style="color:white">Suivant</a>
          </div>


            <div class="step-pane" id="step2" data-parsley-group="block-2">

              <div>
                <label for="exampleFormControlTextarea1" class="form-label">Points forts
                </label>
                <textarea class="form-control" name="point_fort" id="exampleFormControlTextarea1" rows="3" data-parsley-maxlength="255"></textarea>
              </div>
              <div>
                <label for="exampleFormControlTextarea1"  class="form-label">Points à améliorer

                </label>
                <textarea class="form-control" name="point_ameliorer" id="exampleFormControlTextarea1" rows="3" data-parsley-maxlength="255" data-parsley-group="block-2"></textarea>
              </div>
              <div>
                <label for="exampleFormControlTextarea1"  class="form-label">Projet professionnel et perspectives

                </label>
                <textarea class="form-control" name="projet" id="exampleFormControlTextarea1" rows="3" data-parsley-maxlength="255" data-parsley-group="block-2"></textarea>
              </div>
              <div>
                <label for="exampleFormControlTextarea1"  class="form-label">Actions pour la période à venir

                </label>
                <textarea class="form-control" name="action" id="exampleFormControlTextarea1" rows="3" data-parsley-maxlength="255" data-parsley-group="block-2"></textarea>
              </div>
              <div>
                <label for="exampleFormControlTextarea1"  class="form-label">Commentaires

                </label>
                <textarea class="form-control" name="commentaire" id="exampleFormControlTextarea1" rows="3" data-parsley-maxlength="255" data-parsley-group="block-2"></textarea>
              </div>
              <button class="btn btn-primary prev-btn float-start mt-4">Precedent</button>
                <button class="btn btn-primary float-end mt-4" type="submit">Evaluer</button>
            </div>
        </form>
    </div>

    <script>
        function handleNoteChange(categoryId, subCategorieId) {
            appreciation(subCategorieId);
            calculateAverage(categoryId);
        }

        function appreciation(subCategorieId) {
            const noteInput = document.getElementById(`note-${subCategorieId}`);
            const value = parseFloat(noteInput.value);
            const appreciationInput = document.getElementById(`appreciation-${subCategorieId}`);

            let appreciationText = '';
            let backgroundColor = '';

            switch (value) {
                case 1:
                    appreciationText = 'A améliorer';
                    backgroundColor = '#FF0000';
                    break;
                case 2:
                    appreciationText = 'Insuffisant';
                    backgroundColor = '#ED7D31';
                    break;
                case 3:
                    appreciationText = 'Moyen';
                    backgroundColor = '#FFC000';
                    break;
                case 4:
                    appreciationText = 'Bon';
                    backgroundColor = '#A9D08E';
                    break;
                case 5:
                    appreciationText = 'Excellent';
                    backgroundColor = '#70AD47';
                    break;
                default:
                    appreciationText = '';
                    backgroundColor = '';
            }

            appreciationInput.value = appreciationText;
            appreciationInput.style.backgroundColor = backgroundColor;
        }

        function calculateAverage(categoryId) {
            // Get all inputs for this category
            const inputs = document.querySelectorAll(`select[data-category="${categoryId}"]`);

            let sum = 0;
            let count = 0;

            // Calculate the sum of all filled inputs
            inputs.forEach(input => {
                if (input.value !== '') {
                    sum += parseFloat(input.value);
                    count++;
                }
            });

            // Calculate the average
            const average = count > 0 ? (sum / count).toFixed(2) : '';

            // Update the average input
            const averageInput = document.getElementById(`average-note-${categoryId}`);
            if (averageInput) {
                averageInput.value = average;
            }
            calculateFinalNote();
        }
        function calculateFinalNote() {
    const averageInputs = document.querySelectorAll('input[id^="average-note-"]');
    let sum = 0;
    let count = 0;

    averageInputs.forEach(input => {
        if (input.value !== '') {
            sum += parseFloat(input.value);
            count++;
        }
    });

    const finalNote = count > 0 ? (sum / count).toFixed(2) : '';

    const finalNoteInput = document.getElementById('finale-note');
    const finalNoteSent = document.getElementById('note_final');
    if (finalNoteInput) {
        finalNoteInput.value = finalNote;
        finalNoteSent.value = finalNote;
    }
}

function triggerDownloadAndRedirect(pdfUrl, redirectUrl) {
        // Create a hidden link element
        const link = document.createElement('a');
        link.href = pdfUrl;
        link.download = ''; // This will trigger the download
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        // Redirect after a short delay to ensure download starts
        setTimeout(function() {
            window.location.href = redirectUrl;
        }, 100); // Adjust the delay as needed
    }

    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('{{ route("fiche-evaluation-store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.pdf_url && data.redirect_url) {
                triggerDownloadAndRedirect(data.pdf_url, data.redirect_url);
            } else {
                // Handle error case
                console.error('Error:', data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    </script>


@endsection
