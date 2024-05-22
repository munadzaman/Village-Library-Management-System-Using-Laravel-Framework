@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Edit Book</div>
                <div class="card-body">
                    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ $book->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control" id="author" value="{{ $book->author }}" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" class="form-control" id="category" required>
                                <option value="" disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}" {{ $book->category == $category ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="book_id">Book ID</label>
                            <input type="text" name="book_id" class="form-control" id="book_id" value="{{ $book->book_id }}" required>
                        </div>
                        <div class="form-group">
                            <label for="total_copies">Total Copies</label>
                            <input type="number" name="total_copies" class="form-control" id="total_copies" value="{{ $book->total_copies }}" required>
                        </div>
                        <div class="form-group">
                            <label for="available_copies">Available Copies</label>
                            <input type="number" name="available_copies" class="form-control" id="available_copies" value="{{ $book->available_copies }}" required>
                        </div>
                        <div class="form-group">
                            <label for="publisher_name">Publisher Name</label>
                            <input type="text" name="publisher_name" class="form-control" id="publisher_name" value="{{ $book->publisher_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="published_year">Published Year</label>
                            <input type="number" name="published_year" class="form-control" id="published_year" value="{{ $book->published_year }}" required>
                        </div>
                        <div class="form-group">
                            <label for="cover">Book Cover</label>
                            <input type="file" name="cover" class="form-control-file" id="cover">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
