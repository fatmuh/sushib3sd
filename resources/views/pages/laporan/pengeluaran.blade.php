@extends('layouts.app')

@section('title')
<title>SushiB3SD - Laporan Pengeluaran</title>
@endsection

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Laporan Pengeluaran</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan Pengeluaran</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('laporan.pengeluaran') }}" method="get" class="mb-5">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group mb-2">
                        <input type="date" class="form-control"
                            value="{{ !empty(request()->input('start')) ? request()->input('start') : '' }}"
                            name="start">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="date" class="form-control"
                            value="{{ !empty(request()->input('end')) ? request()->input('end') : '' }}" name="end">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group mx-sm-3 mb-2">
                        <select name="export" class="form-control">
                            <option value="xlsx">Excel</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group mx-sm-3 mb-2">
                        <button type="submit" class="btn btn-primary btn-default">Go</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total Pengeluaran</th>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report['date'] }}</td>
                        <td>{{ "Rp".number_format($report['pengeluaran'],2,',','.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">No records found</td>
                    </tr>
                    @endforelse

                    @if ($reports)
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td><strong>{{ "Rp".number_format($total_pengeluaran,2,',','.') }}</strong></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
