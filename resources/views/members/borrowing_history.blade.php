<!-- borrowing_history.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Borrowing History for {{ $member->name }}</div>
                <div class="card-body">
                    @if ($borrowingHistory->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Book Title</th>
                                    <th>Borrow Date</th>
                                    <th>Return Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrowingHistory as $record)
                                    <tr>
                                        <td>{{ $record->book->title }}</td>
                                        <td>{{ $record->borrow_date }}</td>
                                        <td>{{ $record->return_date }}</td>
                                        <td>
                                            @if (!$record->return_date)
                                                <form action="{{ route('borrowing_records.return', $record->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Return</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No borrowing history available for this member.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
