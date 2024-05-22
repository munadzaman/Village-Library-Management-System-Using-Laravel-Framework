@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Add Borrowing Record</div>
                <div class="card-body">
                    <form action="{{ route('borrowing_records.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="member_id">Member</label>
                            <select name="member_id" class="form-control" id="member_id" required>
                                @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="book_id">Book</label>
                            <select name="book_id" class="form-control" id="book_id" required>
                                @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ $book->available_copies == 0 ? 'disabled' : '' }}>
                                    {{ $book->title }} ({{ $book->available_copies }} available copies)
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @foreach($books as $book)
                            @if($book->available_copies == 0)
                                <div class="alert alert-warning" role="alert">
                                    The book "{{ $book->title }}" is not available at the moment.
                                </div>
                            @endif
                        @endforeach
                        <input type="hidden" name="borrow_date" value="{{ now() }}">
                        <input type="hidden" name="return_date" value="">
                        <input type="hidden" name="borrowed_status" value="1">
                        <button type="submit" class="btn btn-primary">Add Borrowing Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
