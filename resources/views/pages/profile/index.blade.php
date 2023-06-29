@extends('layouts.app')

@section('title')
<title>SushiB3SD - Profil</title>
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Profil</h1>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold">Change Profile</h5>
                    <p class="card-subtitle mb-4">To change your personal detail , edit and save from here</p>
                    <form action="{{ route('profil.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div class="note-title">
                                    <label class="mb-2">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', auth()->user()->name) }}" />
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="note-description">
                                    <label class="mb-2">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', auth()->user()->email) }}" />
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
