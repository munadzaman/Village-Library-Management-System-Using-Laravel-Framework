<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use App\Models\BorrowingRecord;

class BookController extends Controller
{
    // Random category list
    protected $categories = [
        'Novel',
        'Religion',
        'Academic',
        'Children',
        'General Readings',
        'Science Fiction',
        'Fantasy',
        'Biography',
        'History',
        'Self-Help',
    ];

    public function index(Request $request)
{
    $query = $request->input('search');

    // If there's a search query, filter the books by book ID
    if ($query) {
        $books = Book::where('book_id', $query)->paginate(10);
    } else {
        // If no search query, fetch all books
        $books = Book::paginate(10);
    }

    return view('books.index', compact('books'));
}

    public function create()
    {
        return view('books.create', ['categories' => $this->categories]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'book_id' => 'required',
            'total_copies' => 'required|numeric',
            'available_copies' => 'required|numeric',
            'publisher_name' => 'required',
            'published_year' => 'required|numeric',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming cover image is uploaded
        ]);

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $validatedData['cover'] = $coverPath;
        }

        Book::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        $categories = [
            'Novel',
            'Religion',
            'Academic',
            'Children',
            'General Readings',
            'Science Fiction',
            'Fantasy',
            'Biography',
            'History',
            'Self-Help',
        ];

        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'book_id' => 'required',
            'total_copies' => 'required|numeric',
            'available_copies' => 'required|numeric',
            'publisher_name' => 'required',
            'published_year' => 'required|numeric',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming cover image is uploaded
        ]);

        if ($request->hasFile('cover')) {
            // Delete previous cover image if exists
            Storage::disk('public')->delete($book->cover);

            $coverPath = $request->file('cover')->store('covers', 'public');
            $validatedData['cover'] = $coverPath;
        }

        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
        {
            // Check if the book has a cover image before attempting to delete it
            if ($book->cover) {
                // Delete the cover image before deleting the book
                Storage::disk('public')->delete($book->cover);
            }

            $book->delete();
            return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
        }

    public function borrowBook(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'member_id' => 'required',
            'borrow_date' => 'required|date',
        ]);

        // Check if there are available copies
        if ($book->available_copies > 0) {
            // Create a borrowing record
            $borrowingRecord = BorrowingRecord::create([
                'member_id' => $validatedData['member_id'],
                'book_id' => $book->id,
                'borrow_date' => $validatedData['borrow_date'],
            ]);

            // Update the available copies
            $book->decrement('available_copies');

            return redirect()->route('books.index')->with('success', 'Book borrowed successfully.');
        } else {
            return redirect()->back()->with('error', 'No available copies of this book.');
        }
    }

    public function returnBook(BorrowingRecord $borrowingRecord)
    {
        // Update the return date
        $borrowingRecord->return_date = now();
        $borrowingRecord->save();

        // Find the book
        $book = $borrowingRecord->book;

        // Update the available copies
        $book->increment('available_copies');

        return redirect()->route('books.index')->with('success', 'Book returned successfully.');
    }
}
