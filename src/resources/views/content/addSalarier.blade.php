@extends('layouts/contentNavbarLayout')

@section('title', 'Ajouter un Salarier')



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
                <form action='{{ url('/add-salarie') }}' method="POST" enctype="multipart/form-data" id="multiStepForm" data-parsley-validate>
                    @csrf
                    <div class="step-pane active" id="step1" data-parsley-group="block-1">
                        <!-- Step 1 content : IDENTIFICATION DE L'ENTREPRISE-->
                        <div class="row g-3 mb-4" data-select2-id="20">
                            <div class="col-md-4 ">
                                <label for="legal_representative_last_name" class="form-label">Nom <span
                                        style="color: #ff3e1d">*</span></label>
                                <input value="{{ old('nom') }}" type="text" name="nom" placeholder="Nom"
                                    aria-label="First name" class="form-control @error('nom') is-invalid @enderror" required
                                    data-parsley-maxlength="255" data-parsley-group="block-1">
                                @error('nom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="legal_representative_first_name" class="form-label">Prénom <span
                                        style="color: #ff3e1d">*</span></label>
                                <input value="{{ old('prenom') }}" type="text" name="prenom" placeholder="Prénom"
                                    aria-label="Last name" class="form-control @error('prenom') is-invalid @enderror"
                                    required data-parsley-maxlength="255" data-parsley-group="block-1">
                                @error('prenom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="legal_representative_first_name" class="form-label">Date de Naissance <span
                                        style="color: #ff3e1d">*</span></label>
                                <input value="{{ old('date_naissance') }}"
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
                                <input value="{{ old('adresse') }}" type="text" name="adresse"
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
                                <select id="defaultSelect" name="situation_familiale"
                                    class="form-select @error('situation_familiale') is-invalid @enderror col-sm-10"
                                    required data-parsley-length="[1,1]" data-parsley-group="block-1">
                                    <option disabled {{ old('situation_familiale') ? '' : 'selected' }}>Situation</option>
                                    <option value="1" {{ old('situation_familiale') == '1' ? 'selected' : '' }}>
                                        Célibataire</option>
                                    <option value="2" {{ old('situation_familiale') == '2' ? 'selected' : '' }}>Marié
                                    </option>
                                    <option value="3" {{ old('situation_familiale') == '3' ? 'selected' : '' }}>
                                        Divorcé</option>
                                    <option value="4" {{ old('situation_familiale') == '4' ? 'selected' : '' }}>
                                        Veuf/Veuve</option>
                                </select>
                                @error('situation_familiale')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-md-4">
                                <label for="legal_representative_last_name" class="form-label">Nombre enfant en charge
                                    <span style="color: #ff3e1d">*</span></label>
                                <input value="{{ old('n_enfant_charge') }}" type="number" name="n_enfant_charge"
                                    id="basic-icon-default-adresse"
                                    class="form-control col-sm-10 @error('n_enfant_charge') is-invalid @enderror"
                                    placeholder="" aria-describedby="basic-icon-default-adresse" required
                                    data-parsley-type="number" data-parsley-group="block-1" />
                                @error('n_enfant_charge')
                                    ando
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-4" data-select2-id="20">
                            <div class="col-md-4">
                                <label for="legal_representative_first_name" class="form-label">CIN <span
                                        style="color: #ff3e1d">*</span></label>
                                <input value="{{ old('cin') }}" type="text" name="cin"
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
                                <input value="{{ old('date_exp_cin') }}"
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
                                    <option value="" selected disabled>Sexe</option>
                                    <option value=1 {{ old('sexe') == '1' ? 'selected' : '' }}>Homme</option>
                                    <option value=2 {{ old('sexe') == '2' ? 'selected' : '' }}>Femme</option>
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
                              <input value="{{ old('phone') }}"
                                  class="form-control @error('phone') is-invalid @enderror" name="phone"
                                  type="text" id="html5-date-input" required data-parsley-type="number"
                                  data-parsley-group="block-1" />

                              @error('phone')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="col-md-4">
                              <label for="legal_representative_first_name" class="form-label">Code Puk </label>
                              <input value="{{ old('puk') }}"
                                  class="form-control @error('puk') is-invalid @enderror" name="puk"
                                  type="text" id="html5-date-input" data-parsley-type="number"
                                  data-parsley-group="block-1" />
                              @error('puk')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>


                      </div>
                        <a class="btn btn-primary float-end next-btn" style="color:white!important">Suivant</a>

                    </div>
                    <div class="step-pane" id="step2" data-parsley-group="block-2">
                        <!-- Step 2 content  : IDENTIFICATION DU REPRESENTANT LEGAL -->
                        <div class="row g-3 mb-4" data-select2-id="20">
                            <div class="col-md-8 ">
                                <label for="legal_representative_last_name"
                                    class="form-label @error('contrat_type') is-invalid @enderror">Contrat <span
                                        style="color: #ff3e1d">*</span></label>

                                <select id="contratType" name="contrat_type" class="form-select col-sm-10" required
                                    data-parsley-length="[1,1]" data-parsley-group="block-2">
                                    <option value="">Contrat</option>
                                    @foreach ($contrats as $contrat)
                                        <option {{ old('contrat_type') == $contrat->id ? 'selected' : '' }}
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
                                <input value="{{ old('date_debut') }}"
                                    class="form-control @error('date_debut') is-invalid @enderror" name="date_debut"
                                    type="date" id="html5-date-input" required data-parsley-group="block-2" />
                                @error('date_debut')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <div class="row g-3 mb-4" data-select2-id="20">
                            <div class="col-md-6 ">
                                <label for="legal_representative_last_name" class="form-label">CNSS <span
                                        style="color: #ff3e1d">*</span></label>
                                <input value="{{ old('cnss') }}" type="text" name="cnss"
                                    id="cnss"
                                    class="@error('cnss') is-invalid @enderror form-control col-sm-10" placeholder=""
                                    aria-describedby="basic-icon-default-adresse"  data-parsley-type="number"
                                    data-parsley-group="block-2" />
                                @error('cnss')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                              <label for="legal_representative_first_name" class="form-label">Numero CIMR <span
                                      style="color: #ff3e1d">*</span></label>
                              <input value="{{ old('cimr') }}"
                                  class="form-control @error('cimr') is-invalid @enderror" name="cimr"
                                  type="text" id="cimr"  data-parsley-type="number"
                                  data-parsley-group="block-2" />
                              @error('n_assurer')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror

                          </div>

                            <div class="col-md-6">
                                <label for="legal_representative_first_name" class="form-label">Numero d'Assurer <span
                                        style="color: #ff3e1d">*</span></label>
                                <input value="{{ old('n_assurer') }}"
                                    class="form-control @error('n_assurer') is-invalid @enderror" name="n_assurer"
                                    type="text" id="n_assurer"  data-parsley-type="number"
                                    data-parsley-group="block-2" />
                                @error('n_assurer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-md-6">
                                <label for="legal_representative_first_name" class="form-label">Date d'expiration RMA
                                    <span style="color: #ff3e1d">*</span></label>
                                <input value="{{ old('date_exp_rma') }}"
                                    class="form-control @error('date_exp_rma') is-invalid @enderror" name="date_exp_rma"
                                    type="date" id="date_rma"  data-parsley-aftertoday
                                    data-parsley-group="block-2" />
                                @error('date_exp_rma')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="row g-3 mb-4" data-select2-id="20">
                            <div class="col-md-4">
                                <label for="legal_representative_first_name" class="form-label">Fonction <span
                                        style="color: #ff3e1d">*</span></label>
                                <input value="{{ old('fonction') }}"
                                    class="form-control @error('fonction') is-invalid @enderror" name="fonction"
                                    type="text" id="html5-date-input" required data-parsley-maxlength="255"
                                    data-parsley-group="block-2" />
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
                                    <option value="">Service</option>
                                    @foreach ($services as $service)
                                        <option {{ old('service_id') == $service->id ? 'selected' : '' }}
                                            value="{{ $service->id }}"> {{ $service->name }}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="legal_representative_first_name" class="form-label">Categorie <span
                                        style="color: #ff3e1d">*</span></label>
                                <input value="{{ old('categorie') }}"
                                    class="form-control @error('categorie') is-invalid @enderror" name="categorie"
                                    type="text" id="html5-date-input" required data-parsley-maxlength="255"
                                    data-parsley-group="block-2" />
                                @error('categorie')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="is_manager" class="form-label">Est-ce un Manager?</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_manager" value="1"
                                        name="is_manager">
                                    <label class="form-check-label" for="is_manager">Oui</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="manager_id" class="form-label">Manager <span
                                        style="color: #ff3e1d">*</span></label>
                                <select id="manager_id" name="manager_id" class="form-select col-sm-10">
                                    <option value="" selected disabled>Sélectionner un manager</option>

                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->nom }} &nbsp;
                                            {{ $manager->prenom }}</option>
                                    @endforeach
                                </select>
                                @error('manager_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <a class="btn btn-primary float-start prev-btn" style="color:white!important">Precedent</a>
                        <a class="btn btn-primary float-end  next-btn" style="color:white!important">Suivant</a>
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
                            @for ($i = 0; $i < 5; $i++)
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
                                                    value='{{ old("nom_contact[ $i]") }}' data-parsley-group="block-3" />
                                            </div>
                                            <div class="col-md-4">
                                                <label for="phone_contact_{{ $i }}" class="form-label">Numero
                                                    Telephone
                                                    <span style="color: #ff3e1d">*</span></label>
                                                <input class="form-control" value='{{ old("phone_contact[ $i]") }}'
                                                    id="phone_contact_{{ $i }}"
                                                    name="phone_contact[{{ $i }}]" type="text"
                                                    data-parsley-group="block-3" />
                                            </div>
                                            <div class="col-md-4">
                                                <label for="lien_familiale_{{ $i }}" class="form-label">Lien
                                                    Familiale
                                                    <span style="color: #ff3e1d">*</span></label>
                                                <input class="form-control" id="lien_familiale_{{ $i }}"
                                                    name="lien_familiale[{{ $i }}]"
                                                    value='{{ old("lien_familiale[ $i]") }}' type="text"
                                                    data-parsley-group="block-3" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <a class="btn btn-primary float-start prev-btn" style="color:white!important">Precedent</a>
                        <a class="btn btn-primary float-end  next-btn" style="color:white!important">Suivant</a>
                    </div>
                    <div class="step-pane" id="step4" data-parsley-group="block-4">
                      <div id="documentsSection" class="row g-3 mb-4" data-select2-id="20">

                            <!-- Dynamic file inputs will be added here -->

                        </div>
                        <button type="submit" class="btn btn-primary float-end"> Enregistrer</button>
                    </div>
            </div>
        </div>


    </div>
    </form>
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
        });

        $(document).ready(function() {
                $('#contratType').on('change', function() {
                    var contratTypeId = $(this).val();
                    if(contratTypeId == 3 || contratTypeId == 5){
                      document.getElementById('cnss').disabled = true;
                      document.getElementById('n_assurer').disabled = true;
                      document.getElementById('date_rma').disabled = true;
                      document.getElementById('cimr').disabled = true;
                      document.getElementById('is_manager').checked = false;
                      document.getElementById('is_manager').disabled = true;
                    }else{
                      document.getElementById('cnss').disabled = false;
                      document.getElementById('n_assurer').disabled = false;
                      document.getElementById('date_rma').disabled = false;
                      document.getElementById('cimr').disabled = false;
                      document.getElementById('is_manager').disabled = false;
                    }
                    if (contratTypeId) {
                        $.ajax({
                            url: '/contrat-types/' + contratTypeId + '/documents',
                            method: 'GET',
                            success: function(data) {
                                $('#documentsSection').empty(); // Clear previous inputs
                                data.forEach(function(document) {
                                    $('#documentsSection').append(`
                            <div class="col-md-4">
                                <label for="document_${document.id}">${document.name}</label>
                                <input type="file" id="document_${document.id}" name="documents[${document.id}]" class="form-control" >
                            </div>
                        `);
                                });
                            },
                            error: function() {
                                console.error('Failed to fetch documents');
                            }
                        });
                    } else {
                        $('#documentsSection')
                    .empty(); // Clear inputs if no contract type is selected
                    }
                });
            });

        document.addEventListener('DOMContentLoaded', function() {
            const isManagerCheckbox = document.getElementById('is_manager');
            const managerSelect = document.getElementById('manager_id');

            isManagerCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    managerSelect.disabled = true;
                    managerSelect.value = ''; // Reset the manager select
                } else {
                    managerSelect.disabled = false;
                }
            });
        });
    </script>
@endsection
