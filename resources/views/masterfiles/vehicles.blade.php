@extends('layouts.app')

@section('title', 'Vehicles')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1 fw-bold">Vehicles Management</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/dashboard') }}"><i class="bi bi-house"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vehicles</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <!-- Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">

                            <!-- Add Vehicle Button -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-vehicle-modal">
                                    <i class="bi bi-plus-lg"></i> Add Vehicle
                                </button>
                            </div>

                            <!-- Add Vehicle Modal (Include separately) -->
                            <div class="p-3">
                                @include('masterfiles.components.add_vehicle')
                            </div>

                            <!-- Vehicles Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Vehicle No</th>
                                            <th>Type</th>
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Color</th>
                                            <th>Status</th>
                                            <th>Fuel Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    
                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- End Card -->

                </div>
            </div>

        </div>
    </div>

</main>
@endsection
