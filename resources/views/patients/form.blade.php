<div class="container d-flex justify-content-center">
    <div class="card shadow-lg p-4" style="max-width: 700px; width: 100%;">
        <div class="card-body">
            <h4 class="text-center mb-4">{{ isset($patient) ? __('messages.edit_patient') : __('messages.add_new_patient') }}</h4>

            <div class="row">
                <!-- Left Column: Required Fields -->
                <div class="col-md-6">
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('messages.name') }}</label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="{{ old('name', $patient->name ?? '') }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">{{ __('messages.gender') }}</label>
                        <select id="gender" name="gender" class="form-select" required>
                            <option value="male" {{ old('gender', $patient->gender ?? '') == 'male' ? 'selected' : '' }}>
                                {{ __('messages.male') }}
                            </option>
                            <option value="female" {{ old('gender', $patient->gender ?? '') == 'female' ? 'selected' : '' }}>
                                {{ __('messages.female') }}
                            </option>
                        </select>
                        @error('gender')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label for="address_id" class="form-label">{{ __('messages.address') }}</label>
                        <select id="address_id" name="address_id" class="form-select">
                            <option value="">{{ __('messages.select_address') }}</option>
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}" {{ old('address_id', $patient->address_id ?? '') == $address->id ? 'selected' : '' }}>
                                    {{ $address->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('address_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">{{ __('messages.date_of_birth') }}</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                               value="{{ old('date_of_birth', $patient->date_of_birth ?? '') }}">
                        @error('date_of_birth')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Right Column: Optional Fields -->
                <div class="col-md-6">
                    <!-- Weight -->
                    <div class="mb-3">
                        <label for="weight" class="form-label">{{ __('messages.weight') }}</label>
                        <input type="number" id="weight" name="weight" class="form-control"
                               value="{{ old('weight', $patient->weight ?? '') }}">
                        @error('weight')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Height -->
                    <div class="mb-3">
                        <label for="height" class="form-label">{{ __('messages.height') }}</label>
                        <input type="number" id="height" name="height" class="form-control"
                               value="{{ old('height', $patient->height ?? '') }}">
                        @error('height')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">{{ __('messages.phone_number') }}</label>
                        <input type="text" id="phone_number" name="phone_number" class="form-control"
                               value="{{ old('phone_number', $patient->phone_number ?? '') }}">
                        @error('phone_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Note -->
                    <div class="mb-3">
                        <label for="note" class="form-label">{{ __('messages.note') }}</label>
                        <textarea id="note" name="note" class="form-control"
                                  rows="1">{{ old('note', $patient->note ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Save & Back Buttons (Same Width, Beautifully Aligned) -->
            <div class="d-flex gap-2 justify-content-center">
                <button style="width: 100px" type="submit" class="btn btn-success btn-sm">{{ __('messages.save') }}</button>
                <a style="width: 100px" href="{{ route('patients.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.back') }}</a>
            </div>
        </div>
    </div>
</div>
