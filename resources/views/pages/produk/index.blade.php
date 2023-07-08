@extends('layouts.app')

@section('title')
<title>SushiB3SD - Produk</title>
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Produk</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
    </div>
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Produk
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h3>
                        <button type="button" data-bs-dismiss="modal">x</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('produk.store') }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label class="col-form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="name" placeholder="Nama Produk" required>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Kategori</label>
                                <select class="form-control" name="kategori_id" required>
                                    <option>---Pilih Kategori---</option>
                                    @foreach ($kategori as $category)
                                        <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Harga Jual</label>
                                <input type="number" class="form-control" name="harga_jual" placeholder="25000" required>
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
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th style="width: 200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $produk)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $produk->product_id }}</td>
                        <td>{{ $produk->name }}</td>
                        <td>{{ $produk->kategori->name }}</td>
                        <td>{{ "Rp".number_format($produk->harga_jual,2,',','.') }}</td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $produk->id }}" class="btn btn-outline-warning"><i class="fas fa-pen"></i></a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $produk->id }}" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @include('pages.produk.delete')
                    @include('pages.produk.edit')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
