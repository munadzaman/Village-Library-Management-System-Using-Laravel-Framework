@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Members
                        </div>
                        <div class="col-md-6 text-right">
                            <form action="{{ route('members.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by IC No." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('members.create') }}" class="btn btn-primary mb-3">Add Member</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>IC No.</th>
                                <th>Address</th>
                                <th>Mobile Number</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                            <tr>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->ic_no }}</td>
                                <td>{{ $member->address }}</td>
                                <td>{{ $member->mobile_number }}</td>
                                <td>{{ $member->borrowed_records->whereNull('return_date')->count() > 0 ? 'Borrowing' : 'Returned' }}</td>
                                <td>
                                    <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    <a href="{{ route('members.borrowing_history', $member->id) }}" class="btn btn-sm btn-info">History</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination Links -->
                    {{ $members->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
