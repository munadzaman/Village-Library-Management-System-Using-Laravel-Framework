<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BorrowingRecord;

class DashboardController extends Controller
{
    public function index()
    {
        // Retrieve total number of books
        $totalBooks = Book::count();

        // Retrieve total number of copies of all books
        $totalCopies = Book::sum('total_copies');

        // Retrieve total number of borrowed records
        $totalBorrowedRecords = BorrowingRecord::count();

        // Retrieve total number of borrowed records that are not returned yet
        $totalBorrowedRecordsNotReturned = BorrowingRecord::whereNull('return_date')->count();

        return view('dashboard', compact('totalBooks', 'totalCopies', 'totalBorrowedRecords', 'totalBorrowedRecordsNotReturned'));
    }
}
