<div class="modal fade" id="ModalDelete{{ $transaksi->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Hapus Transaksi</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('transaksi.delete', ['id' => $transaksi->id]) }}" method="POST">
                    @csrf
                    You sure you want to delete transaction <b>{{ $transaksi->transaction_code }}</b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus Transaksi</button>
            </div>
            </form>
        </div>
    </div>
</div>
