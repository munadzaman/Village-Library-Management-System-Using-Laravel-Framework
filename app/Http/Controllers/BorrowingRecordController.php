<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowingRecord;
use App\Models\Book;
use App\Models\Member;
use Carbon\Carbon;

class BorrowingRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $borrowingRecords = BorrowingRecord::when($search, function($query, $search) {
            return $query->whereHas('book', function($q) use ($search) {
                $q->where('book_id', 'like', "%{$search}%");
            });
        })->paginate(10);

        return view('borrowing_records.index', compact('borrowingRecords', 'search'));
    }

    public function create()
    {
        $books = Book::all();
        $members = Member::all();
        return view('borrowing_records.create', compact('books', 'members'));
    }

    public function store(Request $request)
{
    $request->validate([
        'member_id' => 'required|exists:members,id',
        'book_id' => 'required|exists:books,id',
    ]);

    $member = Member::find($request->member_id);

    // Check if the member already has an active borrowing record for the selected book
    $existingRecord = BorrowingRecord::where('member_id', $request->member_id)
                                     ->where('book_id', $request->book_id)
                                     ->whereNull('return_date')
                                     ->first();

    if ($existingRecord) {
        return redirect()->back()->with('error', 'Member cannot borrow the same book again without returning it first.');
    }

    // Check if the member has borrowed more than 3 books
    $currentlyBorrowedBooks = $member->borrowed_records()->whereNull('return_date')->count();
    if ($currentlyBorrowedBooks >= 3) {
        return redirect()->back()->with('error', 'Member cannot borrow more than 3 books at a time.');
    }

    $borrowingRecord = new BorrowingRecord;
    $borrowingRecord->member_id = $request->member_id;
    $borrowingRecord->book_id = $request->book_id;
    $borrowingRecord->borrow_date = Carbon::now(); // Set borrow_date as Carbon instance
    $borrowingRecord->save();

    $book = Book::find($request->book_id);
    $book->available_copies -= 1;
    $book->save();

    $member->borrowed_status = true;
    $member->save();

    return redirect()->route('borrowing_records.index')->with('success', 'Borrowing record added successfully.');
}

    public function update(Request $request, BorrowingRecord $borrowingRecord)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date',
        ]);

        $borrowingRecord->update($request->all());

        if ($request->return_date) {
            $this->returnBook($borrowingRecord); // Call returnBook method
        }

        return redirect()->route('borrowing_records.index')->with('success', 'Borrowing record updated successfully.');
    }

    public function destroy(BorrowingRecord $borrowingRecord)
    {
        $borrowingRecord->delete();
        return redirect()->route('borrowing_records.index')->with('success', 'Borrowing record deleted successfully.');
    }

    public function returnBook(BorrowingRecord $borrowingRecord)
    {
        $borrowingRecord->update([
            'return_date' => now(),
        ]);

        // Update the available copies of the book
        $book = $borrowingRecord->book;
        $book->available_copies += 1;
        $book->save();

        // Check if there are no remaining borrowing records for this book
        $remainingBorrowingRecords = BorrowingRecord::where('book_id', $book->id)
                                                    ->whereNull('return_date')
                                                    ->count();
        if ($remainingBorrowingRecords === 0) {
            $book->update(['available_copies' => $book->total_copies]);
        }

        // Update the borrowed status of the member if needed
        $member = $borrowingRecord->member;
        $remainingBorrowingRecordsForMember = $member->borrowed_records()->whereNull('return_date')->count();
        if ($remainingBorrowingRecordsForMember === 0) {
            $member->update(['borrowed_status' => false]);
        }

        return redirect()->back()->with('success', 'Book returned successfully.');
    }
}
