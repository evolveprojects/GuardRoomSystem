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

                           <!-- Add Vehicle Button & Search -->
                        <div class="row mb-3 align-items-end">
                            <!-- Add Vehicle Button -->
                            <div class="col-md-6">
                                <div class="mb-2" style="padding-left: 10px;">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-vehicle-modal">
                                        <i class="bi bi-plus-lg"></i> Add Vehicle
                                    </button>
                                </div>
                            </div>

                        <!-- Search Bar -->
                        <div class="col-md-6">
                            <form action="{{ route('Masterfile.vehicles') }}" method="get">
                                <div class="input-group">
                                    <input type="search" name="searchKey" class="form-control"
                                        placeholder="Search by Vehicle No, Type, or Brand"
                                        value="{{ $searchKey ?? '' }}">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                            <!-- Add Vehicle Modal -->
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
                                    <tbody>
                                        @foreach($vehicles as $vehicle)
                                            <tr>
                                                <td>{{ $vehicle->vehicle_no }}</td>
                                                <td>{{ $vehicle->type }}</td>
                                                <td>{{ $vehicle->brand }}</td>
                                                <td>{{ $vehicle->model }}</td>
                                                <td>{{ $vehicle->color }}</td>
                                                <td>
                                                    @if($vehicle->status == 'Active')
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif($vehicle->status == 'Inactive')
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Maintenance</span>
                                                    @endif
                                                </td>
                                                <td>{{ $vehicle->fuel_type }}</td>
                                                <td style="min-width:110px; vertical-align: middle;">
                                                    <div class="accordion accordion-flush" id="accordionVehicle{{ $vehicle->id }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingVehicle{{ $vehicle->id }}">
                                                                <button class="accordion-button collapsed p-1" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#collapseVehicle{{ $vehicle->id }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="collapseVehicle{{ $vehicle->id }}">
                                                                    Actions
                                                                </button>
                                                            </h2>
                                                            <div id="collapseVehicle{{ $vehicle->id }}" class="accordion-collapse collapse"
                                                                aria-labelledby="headingVehicle{{ $vehicle->id }}"
                                                                data-bs-parent="#accordionVehicle{{ $vehicle->id }}">
                                                                <div class="accordion-body p-1">
                                                                    @include('masterfiles.components.edit_vehicle')
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="mt-3">
                                    {{ $vehicles->links() }}
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
@endsection
