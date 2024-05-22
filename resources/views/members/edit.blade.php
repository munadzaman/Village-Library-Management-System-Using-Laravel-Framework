

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Edit Member</div>
                <div class="card-body">
                    <form action="{{ route('members.update', $member->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $member->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="ic_no">IC No.</label>
                            <input type="text" name="ic_no" class="form-control" id="ic_no" value="{{ $member->ic_no }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" id="address" value="{{ $member->address }}" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number</label>
                            <input type="text" name="mobile_number" class="form-control" id="mobile_number" value="{{ $member->mobile_number }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Member</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
