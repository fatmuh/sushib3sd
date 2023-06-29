<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::latest()->get();
        return view('pages.kategori.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        Kategori::create($validatedData);
        return redirect()->route('kategori.index')->with('toast_success', 'Category Added Successfully!');
    }

    public function update(Request $request, $id)
    {
        $item = Kategori::findOrFail($id);
        $data = $request->except(['_token']);
        $item->update($data);
        return redirect()->route('kategori.index')->with('toast_success', 'Category Updated Successfully!');
    }

    public function delete($id)
    {
        $item = Kategori::findOrFail($id);
        $item->delete();
        return redirect()->route('kategori.index')->with('toast_success', 'Category Deleted Successfully!');
    }
}
