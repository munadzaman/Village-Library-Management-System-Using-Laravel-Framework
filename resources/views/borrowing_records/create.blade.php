@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Add Borrowing Record</div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('borrowing_records.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="member_id">Member</label>
                            <select name="member_id" class="form-control" id="member_id" required>
                                <option value="">Select Member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->ic_no }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="book_id">Book</label>
                            <select name="book_id" class="form-control" id="book_id" required>
                                <option value="">Select Book</option>
                                @foreach($books as $book)
                                    @php
                                        $disabled = false;
                                        foreach($member->borrowed_records as $record) {
                                            if ($record->book_id == $book->id && $record->return_date == null) {
                                                $disabled = true;
                                                break;
                                            }
                                        }
                                    @endphp
                                    <option value="{{ $book->id }}" {{ $disabled ? 'disabled' : '' }}>
                                        {{ $book->title }} {{ $disabled ? '(You have already borrowed this)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Borrowing Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
