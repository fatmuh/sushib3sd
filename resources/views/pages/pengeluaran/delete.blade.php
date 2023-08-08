<div class="modal fade" id="ModalDelete{{ $pengeluaran->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Hapus Pengeluaran</h3>

            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('pengeluaran.delete', ['id' => $pengeluaran->id]) }}" method="POST">
                    @csrf
                    You sure you want to delete pengeluaran <b>{{ $pengeluaran->deskripsi }}</b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger">Hapus Pengeluaran</button>
            </div>
            </form>
        </div>
    </div>
</div>
