<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderByRaw("CASE WHEN role = 'Admin' THEN 0 ELSE 1 END")
        ->latest()
        ->get();
        return view('pages.user.index', [
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validatedData['role'] = "Kasir";
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return redirect()->route('user.index')->with('toast_success', 'User Added Successfully!');
    }

    public function update(Request $request, $id)
    {
        $item = User::findOrFail($id);
        $data = $request->except(['_token']);
        $item->update($data);
        return redirect()->route('user.index')->with('toast_success', 'User Updated Successfully!');
    }

    public function delete($id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return redirect()->route('user.index')->with('toast_success', 'User Deleted Successfully!');
    }
}
