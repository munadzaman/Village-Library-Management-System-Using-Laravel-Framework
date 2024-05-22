<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function borrowingHistory(Member $member)
{
    $borrowingHistory = $member->borrowed_records;
    return view('members.borrowing_history', compact('member', 'borrowingHistory'));
}

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $members = Member::when($search, function($query, $search) {
            return $query->where('ic_no', 'like', "%{$search}%");
        })->paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ic_no' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')->with('success', 'Member added successfully');
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ic_no' => 'required|string|max:255|unique:members,ic_no,'.$member->id,
            'address' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255',
            'borrowed_status' => 'required|boolean',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}
