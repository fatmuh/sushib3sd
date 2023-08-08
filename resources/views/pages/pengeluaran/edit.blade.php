<div class="modal fade" id="ModalEdit{{ $pengeluaran->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Pengeluaran</h3>

            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('pengeluaran.update', ['id' => $pengeluaran->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12">
                        <label class="form-label">Tanggal Pengeluaran</label>
                        <input type="date" class="form-control" name="tanggal_pengeluaran" value="{{ old('tanggal_pengeluaran', $pengeluaran->tanggal_pengeluaran) }}">
                    </div>

                    <div class="col-lg-12 mt-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3">{{ old('deskripsi', $pengeluaran->deskripsi) }}</textarea>
                    </div>

                    <div class="col-lg-12 mt-3">
                        <label class="form-label">Nominal</label>
                        <input type="number" class="form-control" name="nominal" value="{{ old('nominal', $pengeluaran->nominal) }}">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Edit Pengeluaran</button>
            </div>
            </form>
        </div>
    </div>
</div>
