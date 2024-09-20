<div class="modal fade" id="ajouter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xxl">
                    <div class="container">
                        <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                            <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Ajouter un Role</h3>
                        </div>
                        <form action="/add-role" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nom du Role</label>
                                <input required placeholder="Nom" type="text" name="name" id="name" class="form-control">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="permissions">Permissions</label>
                                <select name="permissions[]" id="permissions" class="select2 form-control"
                                    multiple="multiple">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('permissions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn btn-primary float-end mt-4">Create Role</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
