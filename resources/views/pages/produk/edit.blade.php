<div class="modal fade" id="ModalEdit{{ $produk->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Produk</h3>

            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{ route('produk.update', ['id' => $produk->id]) }}" method="POST" enctype="multipart/form-data">
                    @method("put")
                    @csrf
                    <div class="col-lg-12">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $produk->name) }}">
                    </div>

                    <div class="col-lg-12 mt-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-control" name="kategori_id" required>
                            <option value="{{ old('kategori_id', $produk->kategori_id) }}">{{ $produk->kategori->name }} (Current)</option>
                            @foreach ($kategori as $category)
                                <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-12 mt-3">
                        <label class="form-label">Harga Jual</label>
                        <input type="number" class="form-control" name="harga_jual" value="{{ old('harga_jual', $produk->harga_jual) }}">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Edit Produk</button>
            </div>
            </form>
        </div>
    </div>
</div>
