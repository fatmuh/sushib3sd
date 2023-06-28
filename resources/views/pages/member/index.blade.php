@extends('layouts.app')

@section('title')
<title>SushiB3SD - Member</title>
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Member</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Member</h6>
    </div>
    <div class="card-body">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Member
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Tambah Member</h3>
                        <button type="button" data-bs-dismiss="modal">x</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('member.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="col-form-label">Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Phone</label>
                                <input type="number" class="form-control" name="phone" required>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">Address</label>
                                <textarea class="form-control" name="address" rows="5" required></textarea>
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
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th style="width: 200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $member)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->phone }}</td>
                        <td>{{ $member->address }}</td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $member->uuid }}" class="btn btn-outline-warning"><i class="fas fa-pen"></i></a>
                            <a href="" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $member->uuid }}" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @include('pages.member.delete')
                    @include('pages.member.edit')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
