<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DetailTransaksi;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{

    public function index()
    {
        $data = Transaksi::latest()->get();
        return view('pages.transaksi.index', [
            'data' => $data,
        ]);
    }

    public function detail($id)
    {
        $data = DetailTransaksi::where('transaction_id', $id)->get();
        $transaksi = Transaksi::where('id', $id)->first();
        return view('pages.transaksi.detail', [
            'data' => $data,
            'transaksi' => $transaksi,
        ]);
    }

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

            $tanggalHariIni = date('dmY');

            $lastTransaction = Transaksi::where('transaction_code', 'like', "P{$tanggalHariIni}%")
                ->orderBy('transaction_code', 'desc')
                ->first();

            if ($lastTransaction) {
                $lastAutoIncrement = intval(substr($lastTransaction->transaction_code, -3));
                $autoIncrement = $lastAutoIncrement + 1;
            } else {
                $autoIncrement = 1;
            }

            $formattedAutoIncrement = str_pad($autoIncrement, 3, '0', STR_PAD_LEFT);

            $transactionParams = [
                'transaction_code' => "P{$tanggalHariIni}{$formattedAutoIncrement}",
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

                    $itemBaseTotal = $cart->quantity * $cart->produk->harga_jual;

					$orderItemParams = [
						'product_id' => $cart->produk_id,
						'transaction_id' => $transaction->id,
						'qty' => $cart->quantity,
						'base_price' => $cart->produk->harga_jual,
						'base_total' => $itemBaseTotal,
					];

					$orderItem = DetailTransaksi::create($orderItemParams);

                    $cart->delete();
				}
            }

            return $transaction;
        });

		if ($transaction) {
			return redirect()->route('transaksi.detail', $transaction->id)->with('toast_success', 'Transaction Successfully!');
		}
    }
    public function delete($id)
    {
        $item = Transaksi::findOrFail($id);
        DetailTransaksi::where('transaction_id', $item->id)->delete();
        $item->delete();
        return redirect()->route('transaksi.index')->with('toast_success', 'Transaction Deleted Successfully!');
    }

    public function print_struck($id)
    {
        $data = DetailTransaksi::where('transaction_id', $id)->get();
        $dataTransaksi = Transaksi::where('id', $id)->first();
        return view('pages.transaksi.nota', [
            'data' => $data,
            'dataTransaksi' => $dataTransaksi,
        ]);
    }

    public function export(Request $request)
    {
        $date = Carbon::now();
        $formattedDate = $date->format('Ymd');
        $exportType = $request->input('export_type');

        $query = Transaksi::query(); // Use query() to create a new query builder instance

        if ($exportType === 'Daily') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($exportType === 'Weekly') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($exportType === 'Monthly') {
            $query->whereMonth('created_at', Carbon::now()->month);
        }

        $export = new TransaksiExport($query->get()); // Execute the query using get()
        $exportData = Excel::download($export, 'transaksi-'.$formattedDate.'.xlsx');

        return $exportData;
    }

}
