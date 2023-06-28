<div class="modal fade" id="ModalAdd{{ $produk->id }}" tabindex="-1" role="dialog" aria-labelledby="tambahobatmodalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary">
                <h6 class="modal-title text-white">Pesan</h6>
            </div>
            <div class="modal-body">
                <div class="notes-box">
                    <div class="notes-content">
                        <form class="row g-3" action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6 mt-3">
                                    <div class="note-title">
                                        <label>Nama Produk</label>
                                        <input type="text" class="form-control" value="{{ old('name', $produk->name) }}" readonly/>
                                        <input type="hidden" class="form-control" name="produk_id" value="{{ old('id', $produk->id) }}"/>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="note-description">
                                        <label>Harga Satuan</label>
                                        <input type="text" class="form-control" value="{{ "Rp".number_format($produk->harga_jual,2,',','.') }}" readonly/>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6 mt-2">
                                    <div class="note-title">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control" name="quantity"
                                            value="{{ old('quantity') }}" oninput="calculateTotal({{ $produk->harga_jual }}, '{{ $produk->id }}')" placeholder="Masukan Jumlah"/>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <div class="note-title">
                                        <label>Total Harga</label>
                                        <input type="text" class="form-control" id="total{{ $produk->id }}" placeholder="Jumlah Order" value="{{ old('quantity') }}" disabled>
                                    </div>
                                </div>

                            </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(amount);
    }

    function calculateTotal(price, id) {
        var quantity = document.querySelector('input[name="quantity"][oninput="calculateTotal(' + price + ', \'' + id + '\')"]').value;
        var total = quantity * price;

        var inputId = 'total' + id;
        document.getElementById(inputId).value = formatCurrency(total);
    }
</script>
