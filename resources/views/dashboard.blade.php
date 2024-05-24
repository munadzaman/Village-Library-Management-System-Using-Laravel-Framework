@extends('layouts.app')

@section('content')
    <!-- Content Row -->
    <div class="row">
        <!-- Total Members Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Members</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMembers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Books Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Books</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBooks }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <!-- Latest Borrowed Books -->
    <div class="row">
        <div class="col-md-12">
            <h3>Latest Borrowed Books</h3>
            <div class="row">
                @foreach ($latestBorrowedBooks as $book)
                    <div class="col-lg-2 col-md-2 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $book->cover) }}" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">Author: {{ $book->author }}</p>
                                <p class="card-text">Borrowed Copies: {{ $book->total_copies - $book->available_copies }}</p>
                                <p class="card-text">Total Copies: {{ $book->total_copies }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Most Borrowed Books -->
    <div class="row">
        <div class="col-md-12">
            <h3>Most Borrowed Books</h3>
            <div class="row">
                @foreach ($mostBorrowedBooks as $book)
                    <div class="col-lg-2 col-md-2 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $book->cover) }}" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">Author: {{ $book->author }}</p>
                                <p class="card-text">Borrowed Times: {{ $book->borrowing_records_count }}</p>
                                <p class="card-text">Total Copies: {{ $book->total_copies }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Books with Low Copies -->
    <div class="row">
        <div class="col-md-12">
            <h3>Books with Low Copies</h3>
            <div class="row">
                @foreach ($booksWithLowCopies as $book)
                    <div class="col-lg-2 col-md-2 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $book->cover) }}" class="card-img-top" alt="Book Cover">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">Author: {{ $book->author }}</p>
                                <p class="card-text">Available Copies: {{ $book->available_copies }}</p>
                                <p class="card-text">Total Copies: {{ $book->total_copies }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
