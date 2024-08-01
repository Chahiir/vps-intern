<div class="modal fade" id="edit-{{ $permission->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xxl">


                    <div class="container">
                        <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                            <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Modifier la Permission
                            </h3>
                        </div>
                        <form action="/edit-permission/{{ $permission->id }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du Permission </label>
                                <input type="text" placeholder="Nom" class="form-control" id="name" name="name"
                                    value="{{ old('name', $permission->name) }}" required>
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror


                            <button type="submit" class="btn btn-primary float-end">Modifier la Permission</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
