<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $today = Carbon::now()->format('Y-m-d');

        $produk = Produk::all()->count();
        $kategori = Kategori::all()->count();
        // $totalPengeluaran = Pengeluaran::whereBetween('created_at', [$startDate, $endDate])->sum('nominal');
        $totalPengeluaran = Pengeluaran::whereDate('created_at', $today)->sum('nominal');
        $totalPendapatan = Transaksi::whereDate('created_at', $today)->sum('price_total');
        return view('home', [
            'kategori' => $kategori,
            'produk' => $produk,
            'total_pengeluaran' => $totalPengeluaran,
            'total_pendapatan' => $totalPendapatan,
        ]);
    }
}
