@extends('layouts.app')

@section('title')
<title>SushiB3SD - Penjualan</title>
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Penjualan</h1>

<div class="row">
    <div class="col-md-6 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Menu</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @php
                    $isCartEmpty = $dataCart->isEmpty();
                    @endphp
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th style="width:20px;">No</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th style="width: 50px"><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $produk)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $produk->product_id }}</td>
                                <td>{{ $produk->name }}</td>
                                <td>{{ "Rp".number_format($produk->harga_jual,2,',','.') }}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#ModalAdd{{ $produk->id }}"
                                        class="btn btn-outline-success"><i class="fas fa-cart-plus"></i></a>
                                </td>
                            </tr>
                            @include('pages.penjualan.add')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-5 mb-4">
        <div class="user-cart">
            <div class="card">
                <table class="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Menu</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Harga</th>
                            <th style="width: 50px" class="text-center"><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataCart as $cart)
                        <tr>
                            <td>{{ $cart->name }}</td>
                            <td class="text-center">{{ $cart->quantity }}</td>
                            <td class="text-center">{{ "Rp".number_format($cart->price,2,',','.') }}</td>
                            <td class="text-center">
                                <a href="" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $cart->id }}"
                                    class="btn btn-outline-warning"><i class="fas fa-pen"></i></a>
                                <a href="" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $cart->id }}"
                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @include('pages.penjualan.edit')
                        @include('pages.penjualan.delete')
                        @endforeach
                    </tbody>
                </table>
                <form action="{{ route('transaksi.store') }}" method="post">
                    @csrf
                    <div class="row px-3">

                        <div class="col-md-12 mt-3">
                            <div class="note-title">
                                <label>Nama Pelanggan</label>
                                <input type="text" value="" name="customer_name" class="form-control"
                                    placeholder="Masukkan Nama Pelanggan" required>
                            </div>
                        </div>

                    </div>

                    <div class="row px-3">
                        <div class="col-md-6 mt-3">
                            <div class="note-description">
                                <label>Uang Diterima</label>
                                <input type="number" class="form-control received" name="accept"
                                    placeholder="Masukan Jumlah" required />
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="note-description">
                                <label>Uang Kembali</label>
                                <input type="text" class="form-control return" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 py-3">
                        <button type="submit" class="btn btn-primary btn-block action-disable" onclick="pay()"
                            @if($isCartEmpty) disabled @endif>Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(amount);
    }

    function pay() {
        const received = parseFloat($('.received').val());
        const totalHarga = parseFloat('{{ $totalHarga }}');
        const subTotal = received - totalHarga;
        const formattedSubTotal = formatCurrency(subTotal);

        if (subTotal >= 0) {
            $('.return').val(formattedSubTotal);
        } else {
            alert('Uang yang diterima kurang');
        }
    }

    $(document).ready(function () {
        const isCartEmpty = '{{ $dataCart->isEmpty() }}';
        $('.action-disable').prop('disabled',
        isCartEmpty); // Menetapkan status awal tombol "Pay" berdasarkan apakah cart kosong atau tidak

        $(document).on('input', '.received', function () {
            const received = parseFloat($(this).val());
            const totalHarga = parseFloat('{{ $totalHarga }}');
            const subTotal = received - totalHarga;
            const formattedSubTotal = formatCurrency(subTotal);

            if (subTotal >= 0) {
                $('.return').val(formattedSubTotal);
            } else {
                $('.return').val('');
            }

            $('.action-disable').prop('disabled', isCartEmpty || subTotal < 0 || isNaN(received));
            // Menetapkan status tombol "Pay" berdasarkan apakah cart kosong, apakah uang yang diterima kurang, atau apakah nilai yang dimasukkan pada field "received" tidak valid (NaN)
        });
    });

</script>
