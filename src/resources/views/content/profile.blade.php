@extends('layouts/contentNavbarLayout')

@section('title', 'Profile')



@section('content')
    <div class="container-xxl ">


        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-6">

                    <div class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8 p-4">
                            <img src="{{ Storage::url(session('photo_profile')) }}" alt="user image"
                                class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img m-2" style="width:20%;height:auto">

                        <div class="flex-grow-1" style="margin-left:10%;margin-top:10%" >
                            <div
                                class="d-flex align-items-md-end align-items-sm-start mt-8 justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4 class="mb-2 mt-lg-7">{{ $user->salarier->nom }} {{ $user->salarier->prenom }}</h4>
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                        <li class="list-inline-item">
                                            <i class="bx bx-palette me-2 align-top"></i><span class="fw-medium">{{$user->role->name}}</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="bx bx-map me-2 align-top"></i><span class="fw-medium">{{$user->salarier->adresse}}</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="bx bx-calendar me-2 align-top"></i><span class="fw-medium">Debut le : {{ \Carbon\Carbon::parse($user->salarier->date_debut)->format('d/m/Y') }}</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->


        <!-- User Profile Content -->
        <div class="row mt-4">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- About User -->
                <div class="card mb-6">
                    <div class="card-body">
                        <small class="card-text text-uppercase text-muted small">About</small>
                        <ul class="list-unstyled my-3 py-1">
                            <li class="d-flex align-items-center mb-4"><i class="bx bx-user"></i><span
                                    class="fw-medium mx-2">Nom Complet:</span> <span>{{ $user->salarier->nom }} {{ $user->salarier->prenom }}</span></li>
                            <li class="d-flex align-items-center mb-4"><i class="bx bx-check"></i><span
                                    class="fw-medium mx-2">Status:</span> <span>
                                      @if ($user->salarier->active)
                                      <td><span class="badge bg-label-success">Active</span></td>
                                  @else
                                      <td><span class="badge bg-label-warning">Inactive</span></td>
                                  @endif
                                    </span></li>
                            <li class="d-flex align-items-center mb-4"><i class="bx bx-crown"></i><span
                                    class="fw-medium mx-2">Role:</span> <span>{{ $user->role->name }}</span></li>
                            <li class="d-flex align-items-center mb-4"><i class="bx bx-flag"></i><span
                                    class="fw-medium mx-2">Service:</span> <span>{{ $user->salarier->service->name }}</span></li>
                            <li class="d-flex align-items-center mb-2"><i class="bx bx-detail"></i><span
                                    class="fw-medium mx-2">Manager:</span> <span>{{ $user->salarier->manager->nom ?? 'Pas de'}} {{ $user->salarier->manager->prenom ?? 'Manager' }}</span></li>
                        </ul>
                        <small class="card-text text-uppercase text-muted small">Contacts</small>
                        <ul class="list-unstyled my-3 py-1">
                            <li class="d-flex align-items-center mb-4"><i class="bx bx-phone"></i><span
                                    class="fw-medium mx-2">Telephone:</span> <span>{{ $user->salarier->phone }}</span></li>
                            <li class="d-flex align-items-center mb-4"><i class="bx bx-envelope"></i><span
                                    class="fw-medium mx-2">Email:</span> <span>{{ $user->email }}</span></li>
                        </ul>
                        <small class="card-text text-uppercase text-muted small">Documents</small>
                        <ul class="list-unstyled mb-0 mt-3 pt-1">
                          @foreach($user->salarier->type->documents as $document)
                          @if($user->salarier->documents->contains($document->id))
                          <li >
                          <p> <label class="info-label">
                            <a href="{{ route('documents.download', ['path' => urlencode(str_replace('public/', '', $user->salarier->documents->find($document->id)->pivot->file_path))]) }}" >
                                {{ $document->name }}
                            </a>
                      </label>
                          </p>
                        </li>
                          @endif
                          @endforeach
                        </ul>
                    </div>
                </div>
                <!--/ About User -->

            </div>
            <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-6">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i
                                class="bx bx-key bx-lg text-body me-4"></i>Changer mot de passe</h5>
                    </div>
                    <form action="/edit-password" method="POST" data-parsley-validate class="m-4">
                      @csrf
                      <div class="form-group">
                          <label for="name">Password</label>
                          <input required placeholder="********" type="password" name="password" id="password" class="form-control" data-parsley-length="[8, 20]"	>
                      </div>
                      @error('password')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                      <div class="form-group">
                          <label for="permissions">Confirmation Password</label>
                          <input required placeholder="********" type="password" name="c_password" id="c_password" class="form-control" data-parsley-equalto="#password">
                      </div>
                      @error('permissions')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                      <button type="submit" class="btn btn-primary float-end mt-4">Modifier</button>
                  </form>
                </div>
                <!--/ Activity Timeline -->

                <!--/ Teams -->
            </div>
        </div>
    </div>
    <!--/ User Profile Content -->

    </div>

@endsection
