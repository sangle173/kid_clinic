@extends('layouts.app')

@section('content')
    <h1>Addresses</h1>
    <a href="{{ route('addresses.create') }}" class="btn btn-primary mb-3">Add New Address</a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($addresses as $index => $address)
            <tr>
                <td>{{ $loop->iteration + ($addresses->currentPage() - 1) * $addresses->perPage() }}</td>
                <td>{{ $address->name }}</td>
                <td>
                    <a href="{{ route('addresses.edit', $address) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('addresses.destroy', $address) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $addresses->links() }}
@endsection
