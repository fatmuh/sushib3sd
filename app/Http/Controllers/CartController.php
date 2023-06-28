<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'produk_id' => 'required',
            'quantity' => 'required',
        ]);

        $isExist = Cart::where('produk_id', $validatedData['produk_id'])->first();

        if($isExist) {
            return redirect()->route('penjualan.index')->with('toast_error', 'Product Already Added!');
        }

        $produk = Produk::findOrFail($validatedData['produk_id']);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['name'] = $produk->name;
        $validatedData['price'] = $validatedData['quantity'] * $produk->harga_jual;

        Cart::create($validatedData);
        return redirect()->route('penjualan.index')->with('toast_success', 'Order Added Successfully!');
    }

    public function update(Request $request, $id)
    {
        $item = Cart::findOrFail($id);
        $data = $request->except(['_token']);
        $produk = Produk::findOrFail($item->produk_id);
        $item->price = $data['quantity'] * $produk->harga_jual;
        $item->update($data);
        $item->save();
        return redirect()->route('penjualan.index')->with('toast_success', 'Order Updated Successfully!');
    }

    public function delete($id)
    {
        $item = Cart::where('id', $id);
        $item->delete();
        return redirect()->route('penjualan.index')->with('toast_success', 'Order Deleted Successfully!');
    }
}
