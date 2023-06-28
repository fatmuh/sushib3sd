<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(){

        $data = Produk::latest()->get();
        $dataCart = Cart::latest()->get();
        $totalHarga = $dataCart->sum('price');

        return view('pages.penjualan.index', compact('data', 'dataCart', 'totalHarga'));
    }
}
