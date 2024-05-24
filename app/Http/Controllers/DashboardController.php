<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve total number of members
        $totalMembers = Member::count();

        // Retrieve latest 10 books that are currently being borrowed
        $latestBorrowedBooks = Book::whereHas('borrowingRecords', function($query) {
            $query->whereNull('return_date');
        })->orderBy('created_at', 'desc')->take(10)->get();

        // Retrieve 10 most borrowed books
        $mostBorrowedBooks = Book::withCount('borrowingRecords')
            ->orderByDesc('borrowing_records_count')
            ->take(10)
            ->get();

        // Retrieve books with available copies less than 5
        $booksWithLowCopies = Book::where('available_copies', '<', 5)->take(10)->get();

        return view('dashboard', compact('totalMembers', 'latestBorrowedBooks', 'mostBorrowedBooks', 'booksWithLowCopies'));
    }
}

