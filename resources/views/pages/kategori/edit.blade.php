<div class="modal fade" id="ModalEdit{{ $kategori->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Kategori</h3>

            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('kategori.update', ['id' => $kategori->id]) }}" method="POST" enctype="multipart/form-data">
                    @method("put")
                    @csrf
                    <div class="col-lg-12">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $kategori->name) }}">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Edit Kategori</button>
            </div>
            </form>
        </div>
    </div>
</div>
