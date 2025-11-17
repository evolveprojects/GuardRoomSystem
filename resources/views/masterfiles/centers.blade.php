@extends('layouts.app')

@section('title', 'Centers')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1 fw-bold">Centers Management</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="bi bi-house"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Centers</li>
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

                            <!-- Add Center Button & Search -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-center-modal">
                                    <i class="bi bi-plus-lg"></i> Add Center
                                </button>
                            </div>

                            <!-- Add Center Modal -->
                            <div class="p-3">
                                @include('masterfiles.components.add_center') {{-- Create this modal separately --}}
                            </div>

                            <!-- Centers Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Center ID</th>
                                            <th>Center Name</th>
                                            <th>Status</th>
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
