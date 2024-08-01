<div class="modal fade" id="modifier-{{ $visiteur->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between position-relative ">
                            <h3 class="mb-8 position-absolute top-100 start-50 translate-middle">Modifier la visite</h3>
                        </div>
                        <br>
                        <div class="card-body">
                            <form method="POST" action="edit-partenaire-visit/{{ $visiteur->id }}">
                                @CSRF
                                <select disabled class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                    <option value="{{ $visiteur->partenaire->id }}" selected>
                                        {{ $visiteur->partenaire->nom }} &nbsp; {{ $visiteur->partenaire->prenom }}
                                    </option>
                                </select>
                                <input type="hidden" name="partenaire_id" value={{ $visiteur->partenaire->id }}>
                                <div>
                                    <label for="exampleFormControlTextarea1" class="form-label">Motif de visite</label>
                                    <textarea required class="form-control" id="exampleFormControlTextarea1" name="motif" rows="2">{{ $visiteur->motif }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Badge</label>
                                    <select disabled class="form-select" id="exampleFormControlSelect1"
                                        aria-label="Default select example">
                                        <option value="{{ $visiteur->badge->id }}" selected>
                                            {{ $visiteur->badge->reference }}</option>
                                    </select>
                                    <input type="hidden" name="badge_id" value={{ $visiteur->badge->id }}>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary float-end">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
