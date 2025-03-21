@extends('layouts.app')

@section('content')
    <div class="card shadow-lg p-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">{{ __('messages.patients') }}</h1>
                <a href="{{ route('patients.create') }}"
                   class="btn btn-primary">{{ __('messages.add_new') }} {{ __('messages.patients') }}</a>
            </div>

            <!-- Search & Filter Form -->
            <form action="{{ route('patients.index') }}" method="GET" class="mb-4">
                <div class="row g-3 align-items-end d-flex">
                    <!-- Search by Name -->
                    <div class="col-md-5">
                        <label for="search" class="form-label">{{ __('messages.search') }}</label>
                        <input type="text" id="search" name="search" class="form-control"
                               placeholder="{{ __('messages.name') }}" value="{{ $search }}">
                    </div>

                    <!-- Filter by Address -->
                    <div class="col-md-4">
                        <label for="address_id" class="form-label">{{ __('messages.address') }}</label>
                        <select id="address_id" name="address_id" class="form-select">
                            <option value="">{{ __('messages.all_addresses') }}</option>
                            @foreach($addresses as $address)
                                <option
                                    value="{{ $address->id }}" {{ $selectedAddress == $address->id ? 'selected' : '' }}>
                                    {{ $address->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter & Reset Buttons -->
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn flex-grow-1 {{ request('search') || request('address_id') ? 'btn-warning' : 'btn-primary' }}"
                                title="{{ __('messages.filter') }}">
                            <i class="fas fa-filter"></i>
                        </button>
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary flex-grow-1" title="{{ __('messages.reset') }}">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.gender') }}</th>
                    <th>{{ __('messages.address') }}</th>
                    <th>{{ __('messages.phone') }}</th>
                    <th>{{ __('messages.weight') }}</th>
                    <th>{{ __('messages.height') }}</th>
                    {{--            <th>{{ __('messages.status') }}</th>--}}
                    <th>{{ __('messages.updated_at') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->gender == 'male' ? __('messages.male') : __('messages.female') }}</td>
                        <td>{{ $patient->address->name }}</td>
                        <td>{{ $patient->phone_number }}</td>
                        <td>{{ $patient->weight }} kg</td>
                        <td>{{ $patient->height }} cm</td>
                        {{--                <td>{{ $patient->status ? __('messages.active') : __('messages.inactive') }}</td>--}}
                        <td>{{ $patient->updated_at ? $patient->updated_at->format('d/m/Y H:i') : $patient->created_at->format('d/m/Y H:i') }}</td>
                        <td class="d-flex">
                            <a href="{{ route('patients.examine-histories', $patient->id) }}"
                               class="btn btn-info btn-sm me-1" title="{{ __('messages.examine_histories') }}">
                                <i class="fas fa-notes-medical"></i>
                            </a>
                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning btn-sm me-1"
                               title="{{ __('messages.edit') }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('{{ __('messages.delete') }}?')"
                                        title="{{ __('messages.delete') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $patients->links() }}
        </div>
    </div>
@endsection
