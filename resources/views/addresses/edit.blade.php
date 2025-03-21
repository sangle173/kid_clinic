@extends('layouts.app')

@section('content')
    <h1>Edit Address</h1>
    <form action="{{ route('addresses.update', $address) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Address Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $address->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('addresses.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
