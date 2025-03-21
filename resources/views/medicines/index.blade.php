@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">{{ __('messages.medicines') }}</h1>
        <a href="{{ route('medicines.create') }}" class="btn btn-primary">{{ __('messages.add_new') }} {{ __('messages.medicines') }}</a>
    </div>
    <!-- Search and Filter Form -->
    <form action="{{ route('medicines.index') }}" method="GET" class="mb-4">
        <div class="row g-3">
            <!-- Search -->
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ $search }}">
            </div>

            <!-- Filter by Category -->
            <div class="col-md-2">
                <select name="category_id" class="form-select">
                    <option value="">Filter by Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter by Medicine Status -->
            <div class="col-md-2">
                <select name="medicine_status_id" class="form-select">
                    <option value="">Filter by Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ $statusId == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter by Brand -->
            <div class="col-md-2">
                <select name="brand_id" class="form-select">
                    <option value="">Filter by Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brandId == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter by Unit -->
            <div class="col-md-2">
                <select name="unit_id" class="form-select">
                    <option value="">Filter by Unit</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ $unitId == $unit->id ? 'selected' : '' }}>
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Apply</button>
            </div>
        </div>
    </form>

    <!-- Medicines Table -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ __('messages.image') }}</th>
            <th>{{ __('messages.name') }}</th>
            <th>{{ __('messages.category') }}</th>
            <th>{{ __('messages.unit') }}</th>
            <th>{{ __('messages.brand') }}</th>
            <th>{{ __('messages.medicine_status') }}</th>
            <th>{{ __('messages.quantity') }}</th>
            <th>{{ __('messages.price') }}</th>
            <th>{{ __('messages.manufacture_date') }}</th>
            <th>{{ __('messages.expired_date') }}</th>
            <th>{{ __('messages.created_at') }}</th>
            <th>{{ __('messages.actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($medicines as $medicine)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ $medicine->image ? asset('storage/' . $medicine->image) : asset('images/no-image.png') }}"
                         alt="{{ $medicine->name }}"
                         class="img-thumbnail"
                         style="max-width: 100px; height: auto; cursor: pointer;"
                         data-bs-toggle="modal"
                         data-bs-target="#imageModal"
                         data-bs-image="{{ $medicine->image ? asset('storage/' . $medicine->image) : asset('images/no-image.png') }}">
                </td>
                <td>{{ $medicine->name }}</td>
                <td>{{ $medicine->category->name }}</td>
                <td>{{ $medicine->unit->name }}</td>
                <td>{{ $medicine->brand->name }}</td>
                <td>{{ $medicine->medicineStatus->name }}</td>
                <td>{{ $medicine->quantity }}</td>
                <td>{{ number_format($medicine->price / 100, 2) }}</td>
                <td>{{ $medicine->manufacture_date ? $medicine->manufacture_date->format('d/m/Y') : __('messages.no_data') }}</td>
                <td>{{ $medicine->expired_date ? $medicine->expired_date->format('d/m/Y') : __('messages.no_data') }}</td>
                <td>{{ $medicine->created_at }}</td>
                <td>
                    <a href="{{ route('medicines.edit', $medicine->id) }}" class="btn btn-warning btn-sm">{{ __('messages.edit') }}</a>
                    <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('{{ __('messages.delete') }}?')">
                            {{ __('messages.delete') }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $medicines->links() }}
    <!-- Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">{{ __('messages.image_preview') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="{{ __('messages.image') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection
