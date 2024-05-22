<?php
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
    $totalMembers = App\Models\Member::count();
    $totalBooks = App\Models\Book::count();
    $books = App\Models\Book::take(8)->get(); 

    return view('dashboard', compact('totalMembers', 'totalBooks', 'books'));
})->middleware('auth')->name('dashboard');


