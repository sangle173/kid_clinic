@extends('layouts.app')

@section('content')
    <div class="card shadow-lg p-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">{{ __('messages.examine_histories') }}</h1>
                <a href="{{ route('examine-histories.create') }}"
                   class="btn btn-primary">{{ __('messages.add_new') }} {{ __('messages.examine_histories') }}</a>

            </div>
            <!-- Search & Filter Form -->
            <form action="{{ route('examine-histories.index') }}" method="GET" class="mb-4">
                <div class="row g-3 align-items-end d-flex">
                    <!-- Search by Patient Name -->
                    <div class="col-md-4">
                        <label for="search" class="form-label">{{ __('messages.search') }}</label>
                        <input type="text" id="search" name="search" class="form-control"
                               placeholder="{{ __('messages.patient_name') }}" value="{{ $search }}">
                    </div>

                    <!-- Filter by Date -->
                    <div class="col-md-3">
                        <label for="date" class="form-label">{{ __('messages.select_date') }}</label>
                        <input type="date" id="date" name="date" class="form-control" value="{{ $selectedDate }}">
                    </div>

                    <!-- Filter & Reset Buttons (Icons) -->
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1 {{ request('search') || request('date') ? 'btn-warning' : 'btn-primary' }}"
                                title="{{ __('messages.filter') }}">
                            <i class="fas fa-filter"></i>
                        </button>
                        <a href="{{ route('examine-histories.index') }}" class="btn btn-secondary flex-grow-1"
                           title="{{ __('messages.reset') }}">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>

            <!-- Table -->
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('messages.patient_name') }}</th>
                    <th>{{ __('messages.diagnose') }}</th>
                    <th>{{ __('messages.symptoms') }}</th>
                    <th>{{ __('messages.prescription') }}</th> <!-- Replace created_at with prescription -->
                    <th>{{ __('messages.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($examineHistories as $history)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-bold text-primary">{{ $history->patient->name }}</td>
                        <td>
                            <ul>
                                @foreach(explode(',', $history->diagnose) as $diagnose)
                                    <li>{{ trim($diagnose) }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach(explode(',', $history->symptoms) as $symptom)
                                    <li>{{ trim($symptom) }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @php
                                $prescriptions = json_decode($history->prescription, true);
                            @endphp
                            @if(!empty($prescriptions))
                                <ul>
                                    @foreach($prescriptions as $prescription)
                                        @php
                                            $medicine = \App\Models\Medicine::find($prescription['medicine_id']);
                                        @endphp
                                        <li>
                                            {{ $medicine ? $medicine->name : __('messages.unknown_medicine') }} -
                                            {{ $prescription['quantity'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">{{ __('messages.no_medicine_prescribed') }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('examine-histories.edit', $history->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('examine-histories.destroy', $history->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('{{ __('messages.delete') }}?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ __('messages.no_results') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            {{ $examineHistories->links() }}
        </div>
    </div>
@endsection
