<div class="modal fade" id="edit-{{ $role->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xxl">


                        <div class="container">
                            <h1>Modifier Role</h1>
                            <form action="{{ route('roles.update',$role->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $role->name) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="permissions" class="form-label">Permissions</label>
                                    <select class="form-control" id="permissions" name="permissions[]" multiple>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}"
                                                @if ($role->permissions->contains($permission->id)) selected @endif>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Modifier le Role</button>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
