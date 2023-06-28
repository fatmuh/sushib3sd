<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $data = Member::latest()->get();
        return view('pages.member.index', [
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $validatedData['uuid'] = Uuid::uuid4();

        Member::create($validatedData);
        return redirect()->route('member.index')->with('toast_success', 'Member Added Successfully!');
    }

    public function update(Request $request, $uuid)
    {
        $item = Member::where('uuid', $uuid);
        $data = $request->except(['_token']);
        $item->update($data);
        return redirect()->route('member.index')->with('toast_success', 'Member Updated Successfully!');
    }

    public function delete($uuid)
    {
        $item = Member::where('uuid', $uuid);
        $item->delete();
        return redirect()->route('member.index')->with('toast_success', 'Member Deleted Successfully!');
    }
}
