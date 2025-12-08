@extends('layouts.app')

@section('title', 'Centers')

@section('content')
    <main class="app-main">

        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">All OutWards </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">
                                    <i class="bi bi-house"></i> Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All OutWards</li>
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

                                <!-- Add Center Button & Search -->
                                <div class="row mb-3">

                                    <!-- Add Center Button -->
                                    <div class="col-md-6 d-flex align-items-center">
                                        <a href="{{ route('outward.outwardtype1') }}"><button class="btn btn-primary">
                                                <i class="bi bi-plus-lg"></i> Add New
                                            </button></a>
                                    </div>

                                    <!-- Search Bar -->
                                    <div class="col-md-6">
                                        <form action="" method="get">
                                            <div class="input-group">
                                                <input type="search" class="form-control" name="searchKey"
                                                    placeholder="Search by Center Name" value="{{ $searchKey ?? '' }}">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                                <!-- Add Center Modal -->
                                {{-- <div class="p-1">
                                @include('masterfiles.components.add_center')
                            </div> --}}

                                <!-- Centers Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped align-middle mb-0">

                                        <thead class="table-light">
                                            <tr>
                                                <th style="">#</th>
                                                <th class="">Outward No</th>
                                                <th class="">Center</th>
                                                <th class="">Vehicle</th>
                                                <th class="">Driver</th>
                                                <th class="">Helper</th>
                                                <th class="">Created by</th>
                                                <th class="">Status</th>
                                                <th class="">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($out_data as $data)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>{{ $data->outward_number }}</td>
                                                    <td>{{ $data->center_name }}</td>
                                                    <td>{{ $data->vehicle_no }}/{{ $data->vehicle_type }}</td>
                                                    <td>{{ $data->driver_name }}</td>
                                                    <td>{{ $data->helper_name }}</td>
                                                    <td>{{ $data->created_by_name }}</td>
                                                    <td>
                                                        @if ($data->status == 0)
                                                            <span class="badge bg-primary">Ongoing</span>
                                                        @else
                                                            <span class="badge bg-success">Completed</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="accordion accordion-flush"
                                                            id="accordionFlush{{ $data->id }}">
                                                            <div class="accordion-item">

                                                                <h2 class="accordion-header"
                                                                    id="flush-heading{{ $data->id }}">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button"
                                                                        style="padding-top: unset; padding-bottom: unset;"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapse{{ $data->id }}"
                                                                        aria-expanded="false"
                                                                        aria-controls="flush-collapse{{ $data->id }}">
                                                                        Actions
                                                                    </button>
                                                                </h2>

                                                                <div id="flush-collapse{{ $data->id }}"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="flush-heading{{ $data->id }}"
                                                                    data-bs-parent="#accordionFlush{{ $data->id }}">

                                                                    <div class="accordion-body"
                                                                        style="padding-top: 8px; padding-bottom: unset;">
                                                                        {{-- @include('masterfiles.components.edit_center') --}}
                                                                        <a href=""><button>edit</button></a>
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
                                        {{-- {{ $centers->onEachSide(1)->links('pagination::bootstrap-5') }} --}}
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
<style>
    .pagination-wrapper nav {
        display: inline-block;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
