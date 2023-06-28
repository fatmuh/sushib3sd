<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = Pengeluaran::latest()->get();
        return view('pages.pengeluaran.index', [
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal_pengeluaran' => 'required',
            'deskripsi' => 'required',
            'nominal' => 'required',
        ]);

        Pengeluaran::create($validatedData);
        return redirect()->route('pengeluaran.index')->with('toast_success', 'Pengeluaran Added Successfully!');
    }

    public function update(Request $request, $id)
    {
        $item = Pengeluaran::where('id', $id);
        $data = $request->except(['_token']);
        $item->update($data);
        return redirect()->route('pengeluaran.index')->with('toast_success', 'Pengeluaran Updated Successfully!');
    }

    public function delete($id)
    {
        $item = Pengeluaran::where('id', $id);
        $item->delete();
        return redirect()->route('pengeluaran.index')->with('toast_success', 'pengeluaran Deleted Successfully!');
    }
}
