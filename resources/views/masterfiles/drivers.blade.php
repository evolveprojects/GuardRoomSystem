@extends('layouts.app')

@section('title', 'Drivers')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Drivers Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Drivers</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    @include('common.alerts')

                    <!-- Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">

                            <!-- Add Driver Button & Search -->
                            <div class="row mb-3">

                                <!-- Add Driver Button -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-driver-modal">
                                        <i class="bi bi-plus-lg"></i> Add Driver
                                    </button>
                                </div>

                                <!-- Search Bar -->
                                <div class="col-md-6">
                                    <form action="{{ route('Masterfile.drivers') }}" method="get">
                                        <div class="input-group">
                                            <input type="search"
                                                   class="form-control"
                                                   name="searchKey"
                                                   placeholder="Driver Name"
                                                   value="{{ $searchKey ?? '' }}">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <!-- Add Driver Modal -->
                            <div class="p-1">
                                @include('masterfiles.components.add_driver')
                            </div>

                            <!-- Drivers Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>EPF Number</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th style="width: 120px;">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($drivers as $index => $driver)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $driver->name }}</td>
                                                <td>{{ $driver->epf_number }}</td>
                                                <td>{{ $driver->email }}</td>
                                                <td>{{ $driver->phone }}</td>
                                                <td>
                                                    @if($driver->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="accordion accordion-flush" id="accordionFlush{{ $driver->id }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-heading{{ $driver->id }}">
                                                                <button class="accordion-button collapsed"
                                                                        type="button"
                                                                        style="padding-top: unset; padding-bottom: unset;"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapse{{ $driver->id }}"
                                                                        aria-expanded="false"
                                                                        aria-controls="flush-collapse{{ $driver->id }}">
                                                                    Actions
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{ $driver->id }}"
                                                                 class="accordion-collapse collapse"
                                                                 aria-labelledby="flush-heading{{ $driver->id }}"
                                                                 data-bs-parent="#accordionFlush{{ $driver->id }}">
                                                                <div class="accordion-body" style="padding-top: 8px; padding-bottom: unset;">
                                                                    @include('masterfiles.components.edit_driver')
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-end mt-4">
                                <div class="pagination-wrapper">
                                    {{ $drivers->onEachSide(1)->links('pagination::bootstrap-5') }}
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Card -->

                </div>
            </div>

        </div>
    </div>

</main>

<!-- Scripts for Select2 in Modals -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 for all driver modals
        $('[id^="edit-driver-modal-"]').on('shown.bs.modal', function() {
            $(this).find('.select2').select2({
                dropdownParent: $(this),
                width: '100%'
            });
        });

        $('[id^="edit-driver-modal-"]').on('hidden.bs.modal', function() {
            $(this).find('.select2').select2('destroy');
        });
    });
</script>

@endsection
<style>
.pagination-wrapper nav {
    display: inline-block;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    /* padding: 8px ; */
    background: #fff;
}

.pagination-wrapper .page-link {
    border-radius: 6px !important;
    padding: 6px 12px;
}

.pagination-wrapper .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}
</style>