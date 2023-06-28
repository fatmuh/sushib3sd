@extends('layouts.app')

@section('title')
<title>SushiB3SD - Pengeluaran</title>
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pengeluaran</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pengeluaran</h6>
    </div>
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Pengeluaran
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengeluaran</h3>
                        <button type="button" data-bs-dismiss="modal">x</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pengeluaran.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="col-form-label">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal_pengeluaran" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Nominal</label>
                                <input type="number" class="form-control" name="nominal" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th style="width:60px;">No</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Nominal</th>
                        <th style="width: 200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $pengeluaran)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d M Y', strtotime($pengeluaran->tanggal_pengeluaran)) }}</td>
                        <td>{{ $pengeluaran->deskripsi }}</td>
                        <td>{{ "Rp".number_format($pengeluaran->nominal,2,',','.') }}</td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $pengeluaran->id }}" class="btn btn-outline-warning"><i class="fas fa-pen"></i></a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $pengeluaran->id }}" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @include('pages.pengeluaran.delete')
                    @include('pages.pengeluaran.edit')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
