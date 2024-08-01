@extends('layouts/contentNavbarLayout')

@section('title', 'Modifier un Salarier')



@section('content')



    <div class="card mb-4">
        <div class="card-header " style="margin: auto">
            <div class="stepper">
                <div class="step active float-start">
                    <a href="#" class="step-trigger" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-title">Information Personelle</div>
                    </a>
                </div>
                <div class="step float-start">
                    <a href="#" class="step-trigger" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-title">Information Professionelle</div>
                    </a>
                </div>
                <div class="step float-start">
                    <a href="#" class="step-trigger" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-title">Information Contact d'Urgences</div>
                    </a>
                </div>
                <div class="step float-start">
                  <a href="#" class="step-trigger" data-step="4">
                      <div class="step-number">4</div>
                      <div class="step-title">Documents</div>
                  </a>
              </div>

            </div>
        </div>
        <div class="card-body">
            <div class="step-content mt-1 ">
              <form action='{{ url("/edit-salarie/$salarie->id") }}' enctype="multipart/form-data" method="POST" id="multiStepForm"
                  data-parsley-validate>
                  @csrf
                  <div class="step-pane active" id="step1" data-parsley-group="block-1">
                      <!-- Step 1 content : IDENTIFICATION DE L'ENTREPRISE-->
                      <div class="row g-3 mb-4" data-select2-id="20">
                          <div class="col-md-4 ">
                              <label for="legal_representative_last_name" class="form-label">Nom <span
                                      style="color: #ff3e1d">*</span></label>
                              <input value="{{ $salarie->nom }}" type="text" name="nom" placeholder="Nom"
                                  aria-label="First name" class="form-control @error('nom') is-invalid @enderror "
                                  required data-parsley-maxlength="255" data-parsley-group="block-1">
                              @error('nom')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-md-4">
                              <label for="legal_representative_first_name" class="form-label">Prénom <span
                                      style="color: #ff3e1d">*</span></label>
                              <input value="{{ $salarie->prenom }}" type="text" name="prenom" placeholder="Prénom"
                                  aria-label="Last name" class="form-control @error('prenom') is-invalid @enderror"
                                  required data-parsley-maxlength="255" data-parsley-group="block-1">
                              @error('prenom')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-md-4">
                              <label for="legal_representative_first_name" class="form-label">Date de Naissance <span
                                      style="color: #ff3e1d">*</span></label>
                              <input value="{{ \Carbon\Carbon::parse($salarie->date_naissance)->format('Y-m-d') }}"
                                  class="form-control @error('date_naissance') is-invalid @enderror" name="date_naissance"
                                  type="date" id="html5-date-input" required data-parsley-age="18"
                                  data-parsley-group="block-1" />
                              @error('date_naissance')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                      <div class="row g-3 mb-4" data-select2-id="20">
                          <div class="col-md-4">
                              <label for="legal_representative_last_name" class="form-label">Adresse <span
                                      style="color: #ff3e1d">*</span></label>
                              <input value="{{ $salarie->adresse }}" type="text" name="adresse"
                                  id="basic-icon-default-adresse"
                                  class="form-control col-sm-10 @error('adresse') is-invalid @enderror" placeholder=""
                                  aria-describedby="basic-icon-default-adresse" required data-parsley-maxlength="255"
                                  data-parsley-group="block-1" />
                              @error('adresse')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-md-4">
                              <label for="legal_representative_first_name" class="form-label">Situation Familiale <span
                                      style="color: #ff3e1d">*</span></label>
                              <select id="defaultSelect" required data-parsley-length="[1,1]" name="situation_familiale"
                                  class="form-select @error('situation_familiale') is-invalid @enderror col-sm-10"
                                  data-parsley-group="block-1">
                                  <option value="1" {{ $salarie->situation_familiale == '1' ? 'selected' : '' }}>
                                      Célibataire</option>
                                  <option value="2" {{ $salarie->situation_familiale == '2' ? 'selected' : '' }}>
                                      Marié</option>
                                  <option value="3" {{ $salarie->situation_familiale == '3' ? 'selected' : '' }}>
                                      Divorcé</option>
                                  <option value="4" {{ $salarie->situation_familiale == '4' ? 'selected' : '' }}>
                                      Veuf/Veuve</option>
                              </select>
                              @error('situation_familiale')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-md-4">
                              <label for="legal_representative_last_name" class="form-label">Nombre enfant en charge
                                  <span style="color: #ff3e1d">*</span></label>
                              <input value="{{ $salarie->n_enfant_charge }}" type="number" name="n_enfant_charge"
                                  id="basic-icon-default-adresse"
                                  class="form-control col-sm-10 @error('n_enfant_charge') is-invalid @enderror"
                                  placeholder="" aria-describedby="basic-icon-default-adresse" required
                                  data-parsley-type="number" data-parsley-group="block-1" />
                              @error('n_enfant_charge')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                      <div class="row g-3 mb-4" data-select2-id="20">
                          <div class="col-md-4">
                              <label for="legal_representative_first_name" class="form-label">CIN <span
                                      style="color: #ff3e1d">*</span></label>
                              <input value="{{ $salarie->cin }}" type="text" name="cin"
                                  id="basic-icon-default-id" class="form-control @error('cin') is-invalid @enderror"
                                  placeholder="" aria-describedby="basic-icon-default-id" required
                                  data-parsley-pattern="/^[A-Za-z]{1,2}[0-9]+$/" data-parsley-group="block-1" />
                              @error('cin')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-md-4">
                              <label for="legal_representative_last_name" class="form-label">Date d'expiration CIN
                                  <span style="color: #ff3e1d">*</span></label>
                              <input value="{{ $salarie->date_exp_cin }}"
                                  class="form-control @error('date_exp_cin') is-invalid @enderror" name="date_exp_cin"
                                  type="date" id="html5-date-input" required data-parsley-aftertoday
                                  data-parsley-group="block-1" />
                              @error('date_exp_cin')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-md-4">
                              <label for="legal_representative_first_name" class="form-label">Sexe <span
                                      style="color: #ff3e1d">*</span></label>
                              <select name="sexe" id=""
                                  class="form-select @error('sexe') is-invalid @enderror" required
                                  data-parsley-length="[1,1]" data-parsley-group="block-1">
                                  <option value="1" {{ $salarie->sexe == '1' ? 'selected' : '' }}>Homme</option>
                                  <option value="2" {{ $salarie->sexe == '2' ? 'selected' : '' }}>Femme</option>
                              </select>

                              @error('sexe')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror

                          </div>
                      </div>
                      <div class="row g-3 mb-4" data-select2-id="20">
                        <div class="col-md-8 ">
                            <label for="legal_representative_last_name" class="form-label">Numero de telephone <span
                                    style="color: #ff3e1d">*</span></label>
                            <input value="{{ $salarie->phone }}" required data-parsley-type="number"
                                data-parsley-group="block-1" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" type="text" id="html5-date-input" />

                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="legal_representative_first_name" class="form-label">Code Puk </label>
                            <input value="{{ $salarie->puk }}" data-parsley-type="number" data-parsley-group="block-1"
                                class="form-control @error('puk') is-invalid @enderror" name="puk" type="text"
                                id="html5-date-input" />
                            @error('puk')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>
                      <a class="btn btn-primary float-end next-btn" style="color:white!important">Suivant</a>
                  </div>
                  <div class="step-pane" id="step2" data-parsley-group="block-2">
                      <!-- Step 2 content  : IDENTIFICATION DU REPRESENTANT LEGAL -->
                      <div class="row g-3 mb-4" data-select2-id="20" data-parsley-group="block-2">
                          <div class="col-md-8 ">
                              <label for="legal_representative_last_name"
                                  class="form-label @error('contrat_type') is-invalid @enderror">Contrat <span
                                      style="color: #ff3e1d">*</span></label>
                              <select id="contratTypeSelect" required data-parsley-length="[1,1]" name="contrat_type"
                                  class="form-select col-sm-10" data-parsley-group="block-2">
                                  <option>Contrat</option>
                                  @foreach ($contrats as $contrat)
                                      <option {{ $salarie->contrat_type == $contrat->id ? 'selected' : '' }}
                                          value="{{ $contrat->id }}"> {{ $contrat->name }}</option>
                                  @endforeach
                              </select>
                              @error('contrat_type')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-md-4">
                              <label for="legal_representative_first_name" class="form-label">Date Debut <span
                                      style="color: #ff3e1d">*</span></label>
                              <input value="{{ \Carbon\Carbon::parse($salarie->date_debut)->format('Y-m-d') }}" required
                                  data-parsley-group="block-2" class="form-control @error('date_debut') is-invalid @enderror"
                                  name="date_debut" type="date" id="html5-date-input" />
                              @error('date_debut')
                                  <span class="text-danger">{{ $message }}</span>a
                              @enderror
                          </div>


                      </div>
                      <div class="row g-3 mb-4" data-select2-id="20">
                          <div class="col-md-6">
                              <label for="legal_representative_last_name" class="form-label">CNSS <span
                                      style="color: #ff3e1d">*</span> </label>
                                  <input value="{{ $salarie->cnss }}" type="text" name="cnss"
                                      id="cnss"
                                      class="@error('cnss') is-invalid @enderror form-control col-sm-10" placeholder=""
                                      aria-describedby="basic-icon-default-adresse" data-parsley-type="number"
                                      data-parsley-group="block-2" />
                              @error('cnss')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>

                          <div class="col-md-6">
                            <label for="legal_representative_first_name" class="form-label">Numero CIMR <span
                                    style="color: #ff3e1d">*</span></label>
                            <input value="{{ $salarie->cimr }}" data-parsley-type="number"
                                data-parsley-group="block-2" class="form-control @error('cimr') is-invalid @enderror"
                                name="cimr" type="text" id="cimr" />
                            @error('cimr')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                          <div class="col-md-6">
                              <label for="legal_representative_first_name" class="form-label">Numero d'Assurer <span
                                      style="color: #ff3e1d">*</span></label>
                              <input value="{{ $salarie->n_assurer }}" data-parsley-type="number"
                                  data-parsley-group="block-2" class="form-control @error('n_assurer') is-invalid @enderror"
                                  name="n_assurer" type="text" id="n_assurer" />
                              @error('n_assurer')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror

                          </div>
                          <div class="col-md-6">
                              <label for="legal_representative_first_name" class="form-label">Date d'expiration RMA <span
                                      style="color: #ff3e1d">*</span></label>
                              <input value="{{ $salarie->date_exp_rma }}" data-parsley-aftertoday
                                  data-parsley-group="block-2" class="form-control @error('date_exp_rma') is-invalid @enderror"
                                  name="date_exp_rma" type="date" id="date_rma" />
                              @error('date_exp_rma')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror

                          </div>
                      </div>
                      <div class="row g-3 mb-4" data-select2-id="20">
                          <div class="col-md-4">
                              <label for="legal_representative_first_name" class="form-label"
                                  >Fonction <span style="color: #ff3e1d">*</span></label>
                              <input value="{{ $salarie->fonction }}" data-parsley-group="block-2"
                                  class="form-control @error('fonction') is-invalid @enderror" name="fonction" type="text"
                                  id="html5-date-input" data-parsley-maxlength="255" required/>
                              @error('fonction')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror

                          </div>
                          <div class="col-md-4 ">
                            <label for="legal_representative_last_name"
                                class="form-label @error('service_id') is-invalid @enderror">Service <span
                                    style="color: #ff3e1d">*</span></label>

                            <select id="defaultSelect" name="service_id" class="form-select col-sm-10" required
                                data-parsley-length="[1,1]" data-parsley-group="block-2">
                                @foreach ($services as $service)
                                    <option @if($service->id == $salarie->service_id) selected @endif
                                        value="{{ $service->id }}"> {{ $service->name }}</option>
                                @endforeach
                            </select>
                            @error('contrat_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                          <div class="col-md-4">
                              <label for="legal_representative_first_name" class="form-label">Categorie <span
                                      style="color: #ff3e1d">*</span></label>
                              <input value="{{ $salarie->categorie }}" data-parsley-maxlength="255" required
                                  data-parsley-group="block-2" class="form-control @error('categorie') is-invalid @enderror"
                                  name="categorie" type="text" id="html5-date-input" />
                              @error('categorie')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror

                          </div>
                      </div>
                      <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="is_manager" class="form-label">Est-ce un Manager?</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" @if($salarie->is_manager) checked @endif type="checkbox" id="is_manager" value="1" name="is_manager">
                                <label class="form-check-label" for="is_manager">Oui</label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="manager_id" class="form-label">Manager <span style="color: #ff3e1d">*</span></label>
                            <select id="manager_id" name="manager_id" class="form-select col-sm-10" >
                                <option value="" selected disabled></option>
                                @foreach ($managers as $manager)
                                    <option @if($salarie->manager_id == $manager->id) selected @endif value="{{ $manager->id }}">{{ $manager->nom }} &nbsp; {{ $manager->prenom }}</option>
                                @endforeach
                            </select>
                            @error('manager_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                      <a class="btn btn-primary float-start prev-btn" style="color:white!important">Precedent</a>
                      <a class="btn btn-primary float-end next-btn" style="color:white!important">Suivant</a>

                  </div>
                  <div class="step-pane" id="step3" data-parsley-group="block-3">
                      <!-- Step 3 content: Contact d'Urgences -->
                      <div class="d-flex justify-content-between align-items-center mb-3">
                          <h5>Contacts d'Urgence</h5>
                          <button type="button" class="btn btn-primary btn-sm" id="addContactBtn">
                              <i class="bx bx-plus"></i>
                          </button>
                      </div>
                      <div id="contactsContainer">
                        @php $i = 0;@endphp
                          @foreach($contactUrgences as $contact)
                              <div class="contact-urgence" >
                                  <div class="position-relative mb-4">
                                      @if ($i > 0)
                                          <div class="position-absolute top-0 end-0 mt-1 ">
                                              <button type="button" class="btn btn-danger btn-sm  remove-contact">
                                                  <i class="bx bx-minus  remove-contact"></i>
                                              </button>
                                          </div>
                                      @endif
                                      <div class="row g-3">
                                          <div class="col-md-4">
                                              <label for="nom_contact_{{ $i }}" class="form-label">Nom
                                                  Contact
                                                  <span style="color: #ff3e1d">*</span></label>
                                              <input class="form-control" id="nom_contact_{{ $i }}"
                                                  name="nom_contact[{{ $i }}]" type="text"
                                                  data-parsley-group="block-3" value="{{ $contact->nom_contact }}"/>
                                          </div>
                                          <div class="col-md-4">
                                              <label for="phone_contact_{{ $i }}" class="form-label">Numero
                                                  Telephone
                                                  <span style="color: #ff3e1d">*</span></label>
                                              <input class="form-control" id="phone_contact_{{ $i }}"
                                                  name="phone_contact[{{ $i }}]" type="text"
                                                  data-parsley-group="block-3" value="{{ $contact->phone_contact }}"/>
                                          </div>
                                          <div class="col-md-4">
                                              <label for="lien_familiale_{{ $i }}" class="form-label">Lien
                                                  Familiale
                                                  <span style="color: #ff3e1d">*</span></label>
                                              <input class="form-control" id="lien_familiale_{{ $i }}"
                                                  name="lien_familiale[{{ $i }}]" type="text"
                                                    data-parsley-group="block-3" value="{{ $contact->lien_familiale }}"/>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              @php $i++ @endphp
                          @endforeach
                          @for ($i; $i < 5; $i++)
                              <div class="contact-urgence" style="{{ $i > 0 ? 'display:none;' : '' }}">
                                  <div class="position-relative mb-4">
                                      @if ($i > 0)
                                          <div class="position-absolute top-0 end-0 mt-1 ">
                                              <button type="button" class="btn btn-danger btn-sm  remove-contact">
                                                  <i class="bx bx-minus  remove-contact"></i>
                                              </button>
                                          </div>
                                      @endif
                                      <div class="row g-3">
                                          <div class="col-md-4">
                                              <label for="nom_contact_{{ $i }}" class="form-label">Nom
                                                  Contact
                                                  <span style="color: #ff3e1d">*</span></label>
                                              <input class="form-control" id="nom_contact_{{ $i }}"
                                                  name="nom_contact[{{ $i }}]" type="text"
                                                  data-parsley-group="block-3" />
                                          </div>
                                          <div class="col-md-4">
                                              <label for="phone_contact_{{ $i }}" class="form-label">Numero
                                                  Telephone
                                                  <span style="color: #ff3e1d">*</span></label>
                                              <input class="form-control" id="phone_contact_{{ $i }}"
                                                  name="phone_contact[{{ $i }}]" type="text"
                                                  data-parsley-group="block-3" />
                                          </div>
                                          <div class="col-md-4">
                                              <label for="lien_familiale_{{ $i }}" class="form-label">Lien
                                                  Familiale
                                                  <span style="color: #ff3e1d">*</span></label>
                                              <input class="form-control" id="lien_familiale_{{ $i }}"
                                                  name="lien_familiale[{{ $i }}]" type="text"
                                                    data-parsley-group="block-3" />
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          @endfor
                      </div>
                      <a class="btn btn-primary float-start prev-btn" style="color:white!important">Precedent</a>
                      <a class="btn btn-primary float-end next-btn" style="color:white!important" >Suivant</a>
                  </div>
                  <div class="step-pane" id="step4" data-parsley-group="block-4">
                    <div id="file-inputs" class="row g-3">
                      @foreach($documents as $document)
                      <div class="col-md-4">
                              <label>{{ $document->name }}</label>
                              <input type="file" name="documents[{{ $document->id }}]" class="form-control">
                              @if($salarie->documents->contains($document->id))
                              <p> Déjà téléchargé:
                                <a href="{{ route('documents.download', ['path' => urlencode(str_replace('public/', '', $salarie->documents->find($document->id)->pivot->file_path))]) }}" >
                                    {{ $document->name }}
                                </a>
                              </p>
                              @endif
                      </div>
                      @endforeach
                  </div>
                  <button type="submit" class="btn btn-primary float-end mt-4">Modifier</button>
                  </div>

              </form>
            </div>
        </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
    const contactsContainer = document.getElementById('contactsContainer');
    const addContactBtn = document.getElementById('addContactBtn');
    let visibleContacts = 1;

    addContactBtn.addEventListener('click', function() {
        if (visibleContacts < 5) {
            const nextContact = contactsContainer.children[visibleContacts];
            nextContact.style.display = 'block';
            const inputs = nextContact.querySelectorAll('input');
            inputs.forEach(input => input.required = true);
            visibleContacts++;
        }
        if (visibleContacts === 5) {
            addContactBtn.style.display = 'none';
        }
    });

    contactsContainer.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-contact')) {
            const contactToRemove = e.target.closest('.contact-urgence');
            contactToRemove.style.display = 'none';
            const inputs = contactToRemove.querySelectorAll('input');
            inputs.forEach(input => {
                input.required = false;
                input.value = '';
            });
            visibleContacts--;
            addContactBtn.style.display = 'inline-block';

            // Re-order visible contacts
            const contacts = contactsContainer.children;
            let visibleIndex = 0;
            for (let i = 0; i < contacts.length; i++) {
                if (contacts[i].style.display !== 'none') {
                    contacts[i].style.order = visibleIndex;
                    visibleIndex++;
                } else {
                    contacts[i].style.order = 999; // Push hidden contacts to the end
                }
            }
        }
    });

    const contratTypeSelect = document.getElementById('contratTypeSelect');
    const cnss = document.getElementById('cnss');
    const nAssurer = document.getElementById('n_assurer');
    const dateRma = document.getElementById('date_rma');
    const cimr = document.getElementById('cimr');
    const isManagerCheckbox = document.getElementById('is_manager');
    const managerSelect = document.getElementById('manager_id');


    function toggleFields(contratTypeId) {
        if (contratTypeId == 3 || contratTypeId == 5) {
            cnss.disabled = true;
            nAssurer.disabled = true;
            dateRma.disabled = true;
            cimr.disabled = true;
            isManagerCheckbox.checked = false;
            isManagerCheckbox.disabled = true;
        } else {
            cnss.disabled = false;
            nAssurer.disabled = false;
            dateRma.disabled = false;
            cimr.disabled = false;
            isManagerCheckbox.disabled = false;
        }
    }

    // Initialize the state on page load
    toggleFields(contratTypeSelect.value);

    // Add event listener for changes on the select element
    contratTypeSelect.addEventListener('change', function() {
        toggleFields(this.value);
    });



    function toggleManagerSelect() {
        if (isManagerCheckbox.checked) {
            managerSelect.disabled = true;
            managerSelect.value = ''; // Reset the manager select
        } else {
            managerSelect.disabled = false;
        }
    }

    // Initialize the state on page load
    toggleManagerSelect();

    // Add event listener for changes on the is_manager checkbox
    isManagerCheckbox.addEventListener('change', function() {
        toggleManagerSelect();
    });
});



  </script>


@endsection
