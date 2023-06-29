@extends('layouts.app')

@section('title')
<title>SushiB3SD - Transaksi</title>
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Transaksi</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
    </div>
    <div class="card-body">

        <form action="{{ route('transaksi.export') }}" class="form-inline mb-3" method="GET">
            <div class="form-group">
                <select placeholder="Tipe" name="export_type" class="form-control">
                    <option value="">All Data</option>
                    <option value="Daily">Daily</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>
                </select>
            </div>
            <div class="form-group mx-sm-2">
                <button type="submit" class="btn btn-primary">Export</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th style="width:60px;">No</th>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Harga</th>
                        <th>Kasir</th>
                        <th style="width: 200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $transaksi)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d M Y J\a\m H:i:s', strtotime($transaksi->created_at)) }}</td>
                        <td>{{ $transaksi->transaction_code }}</td>
                        <td>{{ $transaksi->customer_name }}</td>
                        <td>{{ "Rp".number_format($transaksi->price_total,2,',','.') }}</td>
                        <td>{{ $transaksi->created_by }}</td>
                        <td>
                            <a href="{{ route('transaksi.detail', $transaksi->id) }}" class="btn btn-outline-info"><i class="fas fa-eye"></i></a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $transaksi->id }}" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @include('pages.transaksi.delete')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
