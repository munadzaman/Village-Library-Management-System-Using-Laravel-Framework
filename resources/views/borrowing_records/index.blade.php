@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Borrowing Records
                        </div>
                        <div class="col-md-6 text-right">
                            <form action="{{ route('borrowing_records.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by Book ID" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('borrowing_records.create') }}" class="btn btn-primary mb-3">Add Borrowing Record</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Member Name</th>
                                <th>IC No</th>
                                <th>Book Title</th>
                                <th>Book ID</th>
                                <th>Borrow Date</th>
                                <th>Return Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($borrowingRecords as $record)
                            <tr>
                                <td>{{ $record->member->name }}</td>
                                <td>{{ $record->member->ic_no }}</td>
                                <td>{{ $record->book->title }}</td>
                                <td>{{ $record->book->book_id }}</td>
                                <td>{{ $record->borrow_date }}</td>
                                <td>{{ $record->return_date }}</td>
                                <td>
                                    @if ($record->return_date === null)
                                        <form action="{{ route('borrowing_records.return', $record->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Return</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('borrowing_records.destroy', $record->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $borrowingRecords->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
