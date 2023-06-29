@extends('layouts.app')

@section('title')
<title>SushiB3SD - Change Password</title>
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Change Password</h1>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Change Password</h5>
                    <p class="card-subtitle mb-4">To change your password please confirm here</p>
                    <form action="{{ route('profil.changePassword.post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <div class="note-title">
                                    <label class="mb-2">Password Lama</label>
                                    <input type="password" class="form-control" name="old_password" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div class="note-title">
                                    <label class="mb-2">Password Baru</label>
                                    <input type="password" class="form-control" name="password" />
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="note-title">
                                    <label class="mb-2">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" name="password_confirmation" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
