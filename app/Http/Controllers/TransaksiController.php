<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{

    public function store(Request $request)
    {
        $params = $request->all();

        $transaction = \DB::transaction(function() use ($params) {

            $carts = Cart::all();

            if($carts->isEmpty()) {
                return redirect()->route('penjualan.index')->with('toast_error', 'Transaction is Empty!');
            }

            $totalHarga = $carts->sum('price');
            $return = $params['accept'] - $totalHarga;

            $transactionParams = [
                'transaction_code' => 'P100' . mt_rand(1,1000),
                'customer_name' => $params['customer_name'],
                'price_total' => $totalHarga,
                'accept' => $params['accept'],
                'return' => $return,
                'created_by' => auth()->user()->name,
			];

			$transaction = Transaksi::create($transactionParams);

            $carts = Cart::all();

			if ($transaction && $carts) {
				foreach ($carts as $cart) {

                    $itemBaseTotal = $cart->quantity * $cart->price;

					$orderItemParams = [
						'product_id' => $cart->produk_id,
						'transaction_id' => $transaction->id,
						'qty' => $cart->quantity,
						'base_price' => $cart->price,
						'base_total' => $itemBaseTotal,
					];

					$orderItem = DetailTransaksi::create($orderItemParams);

                    $cart->delete();
				}
            }

            return $transaction;
        });

		if ($transaction) {
			return redirect()->route('penjualan.index')->with('toast_success', 'Transaction Successfully!');
		}
    }
}