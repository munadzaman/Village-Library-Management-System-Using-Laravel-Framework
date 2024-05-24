<?php
use App\Models\Member;
use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingRecordController;

// Authentication Routes
Auth::routes();


// Group routes that require authentication
Route::middleware('auth')->group(function() {

    // Supervisor routes
    Route::middleware('role:supervisor')->group(function() {
        Route::resource('users', UserController::class);
    });

    // Shared routes for both roles
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);

    Route::resource('borrowing_records', BorrowingRecordController::class);
    Route::post('borrowing_records/{borrowingRecord}/return', [BorrowingRecordController::class, 'returnBook'])->name('borrowing_records.return');
    Route::delete('/borrowing_records/{borrowingRecord}', [BorrowingRecordController::class, 'destroy'])->name('borrowing_records.destroy');

    Route::get('members/{member}/borrowing_history', [MemberController::class, 'borrowingHistory'])->name('members.borrowing_history');

});


Route::get('/', function () {
    // Retrieve necessary data for the dashboard
    $totalMembers = Member::count();
    $totalBooks = Book::count();
    $latestBorrowedBooks = Book::whereHas('borrowingRecords', function($query) {
        $query->whereNull('return_date');
    })->orderBy('created_at', 'desc')->take(10)->get();
    $mostBorrowedBooks = Book::withCount(['borrowingRecords' => function($query) {
        $query->whereNull('return_date');
    }])->orderBy('borrowing_records_count', 'desc')->get();
    $booksWithLowCopies = Book::where('available_copies', '<', 5)->get();

    return view('dashboard', compact('totalMembers', 'totalBooks', 'latestBorrowedBooks', 'mostBorrowedBooks', 'booksWithLowCopies'));
})->middleware('auth')->name('dashboard');


