<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::all();
        $kategori = Kategori::all();
        return view('pages.produk.index', compact('data', 'kategori'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'kategori_id' => 'required',
            'harga_jual' => 'required',
        ]);

        $lastProductId = Produk::orderBy('product_id', 'desc')->first();

        if ($lastProductId) {
            $lastAutoIncrement = intval(substr($lastProductId->product_id, -4));
            $autoIncrement = $lastAutoIncrement + 1;
        } else {
            $autoIncrement = 1;
        }

        $formattedAutoIncrement = sprintf('%04d', $autoIncrement);

        $validatedData['product_id'] =  "SB{$formattedAutoIncrement}";

        Produk::create($validatedData);
        return redirect()->route('produk.index')->with('toast_success', 'Product Added Successfully!');
    }

    public function update(Request $request, $id)
    {
        $item = Produk::findOrFail($id);
        $data = $request->except(['_token']);
        $item->update($data);
        return redirect()->route('produk.index')->with('toast_success', 'Product Updated Successfully!');
    }

    public function delete($id)
    {
        $item = Produk::findOrFail($id);
        $item->delete();
        return redirect()->route('produk.index')->with('toast_success', 'Product Deleted Successfully!');
    }
}
