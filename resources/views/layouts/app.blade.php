<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.clinic') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <!-- Select2 (For Searchable Dropdowns) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

    <style>
        /* Highlight the active link */
        .nav-link.active {
            font-weight: bold;
            color: #f8f9fa !important;
        }
        .bootstrap-tagsinput {
            width: 100%;
        }
        ul {
            list-style-type: disc;
            padding-left: 20px;
        }
        li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('examine-histories.index') }}">{{ __('messages.clinic') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('messages.toggle_navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('patients*') ? 'active' : '' }}" href="{{ route('patients.index') }}">{{ __('messages.patients') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('addresses*') ? 'active' : '' }}" href="{{ route('addresses.index') }}">{{ __('messages.addresses') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('examine-histories*') ? 'active' : '' }}" href="{{ route('examine-histories.index') }}">{{ __('messages.examine_histories') }}</a>
                </li>

                <!-- Medicine Management Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('medicines*') || request()->is('medicine-statuses*') || request()->is('units*') || request()->is('brands*') || request()->is('medicine-categories*') ? 'active' : '' }}" href="#" id="medicineDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('messages.medicine_management') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="medicineDropdown">
                        <li><a class="dropdown-item {{ request()->is('medicines*') ? 'active' : '' }}" href="{{ route('medicines.index') }}">{{ __('messages.medicines') }}</a></li>
                        <li><a class="dropdown-item {{ request()->is('medicine-categories*') ? 'active' : '' }}" href="{{ route('medicine-categories.index') }}">{{ __('messages.medicine_categories') }}</a></li>
                        <li><a class="dropdown-item {{ request()->is('medicine-statuses*') ? 'active' : '' }}" href="{{ route('medicine-statuses.index') }}">{{ __('messages.medicine_status') }}</a></li>
                        <li><a class="dropdown-item {{ request()->is('units*') ? 'active' : '' }}" href="{{ route('units.index') }}">{{ __('messages.units') }}</a></li>
                        <li><a class="dropdown-item {{ request()->is('brands*') ? 'active' : '' }}" href="{{ route('brands.index') }}">{{ __('messages.brands') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>



<div class="container">
    @yield('content')
</div>
<!-- jQuery (Required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');

        imageModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // The image element that triggered the modal
            const imageSrc = button.getAttribute('data-bs-image'); // Get the image URL
            modalImage.setAttribute('src', imageSrc); // Update the modal's image src
        });
    });
</script>
</body>
</html>
