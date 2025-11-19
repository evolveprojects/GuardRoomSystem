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
                        <div class="row mb-3">
                            <!-- Add Center Button -->
                            <div class="col-md-6 d-flex align-items-center">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-center-modal">
                                    <i class="bi bi-plus-lg"></i> Add Center
                                </button>
                            </div>

                            <!-- Search Bar -->
                            <div class="col-md-6">
                                <form action="{{ route('Masterfile.centers') }}" method="get">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="searchKey"
                                            placeholder="Center Name" value="{{ $searchKey ?? '' }}">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                            <!-- Add Center Modal -->
                            <div class="p-3">
                                @include('masterfiles.components.add_center') 
                            </div>

                            <!-- Centers Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <tr>
                                                <th class="w-25">Center ID</th>
                                                <th class="w-25">Center Name</th>
                                                <th class="w-25">Status</th>
                                                <th class="w-25">Actions</th>
                                            </tr>
                                        </tr>
                                    </thead>
                               
                                    <tbody>
                                        @foreach($centers as $center)
                                            <tr>
                                                <td>{{ $center->center_id }}</td>
                                                <td>{{ $center->center_name }}</td>
                                                <td>
                                                    @if($center->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                               
                                                <td>
                                                    <div class="accordion accordion-flush"
                                                        id="accordionFlush{{ $center->id }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="flush-heading{{ $center->id }}">
                                                                <button class="accordion-button collapsed" type="button"
                                                                    style="padding-top: unset;padding-bottom: unset;"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapse{{ $center->id }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="flush-collapse{{ $center->id }}">
                                                                    Actions
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{ $center->id }}"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="flush-heading{{ $center->id }}"
                                                                data-bs-parent="#accordionFlush{{ $center->id }}">
                                                                <div class="accordion-body"
                                                                    style="padding-top: 8px;padding-bottom: unset;">
                                                                    @include('masterfiles.components.edit_center') <br>
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
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
