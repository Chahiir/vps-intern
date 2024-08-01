<div class="modal fade" id="edit-{{ $role->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xxl">


                    <div class="container">
                        <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                            <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Modifier le Role</h3>
                        </div>
                        <form action='{{ url("/edit-role/$role->id") }}' method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du Role</label>
                                <input type="text" placeholder="Nom" class="form-control" id="name" name="name"
                                    value="{{ old('name', $role->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="permissions" class="form-label">Permissions</label> <br>
                                <select class="select2 form-control" id="permissions" name="permissions[]"
                                    multiple="multiple">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}"
                                            @if ($role->permissions->contains($permission->id)) selected @endif>
                                            {{ $permission->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary float-end">Modifier le Role</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
