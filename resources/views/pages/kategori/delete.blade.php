<div class="modal fade" id="ModalDelete{{ $kategori->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Hapus Kategori</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('kategori.delete', ['id' => $kategori->id]) }}" method="POST">
                    @method("put")
                    @csrf
                    You sure you want to delete category <b>{{ $kategori->name }}</b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus Kategori</button>
            </div>
            </form>
        </div>
    </div>
</div>
