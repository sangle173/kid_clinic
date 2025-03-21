@extends('layouts.app')

@section('content')
    <h1>Brands</h1>
    <a href="{{ route('brands.create') }}" class="btn btn-primary mb-3">Add New Brand</a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($brands as $index => $brand)
            <tr>
                <td>{{ $loop->iteration + ($brands->currentPage() - 1) * $brands->perPage() }}</td>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $brands->links() }}
@endsection
