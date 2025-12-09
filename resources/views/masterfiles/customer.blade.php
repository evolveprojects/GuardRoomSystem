@extends('layouts.app')

@section('title', 'Payment')

@section('content')
    <main class="app-main">

        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Customer Management</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Customers</li>
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

                                <!-- Add Vehicle Button & Search -->
                                <div class="row mb-3 align-items-end">

                                    <!-- Add Vehicle Button -->
                                    <div class="col-md-6">
                                        <div class="mb-2" style="padding-left: 10px;">
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#add-customer-modal">
                                                <i class="bi bi-plus-lg"></i> Add Customers
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Search Bar -->
                                    <div class="col-md-6">
                                        <form action="{{ route('Masterfile.customers') }}" method="get">
                                            <div class="input-group">
                                                <input type="search" name="searchKey" class="form-control"
                                                    placeholder="Search by Customer No or Type "
                                                    value="{{ $searchKey ?? '' }}">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                                <!-- Add Vehicle Modal -->
                                <div class="p-1">
                                    @include('masterfiles.components.add_customers', ['customers' => $customers])
                                </div>

                                <!-- Vehicles Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 15px">#</th>
                                                <th>Customer No</th>
                                                <th>Customer Name</th>
                                                <th>Distance</th>
                                                <th>Type</th>
                                                <th>Assign Value</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($customers_local as $lo_cus)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $lo_cus->customers}}</td>
                                                    <td>{{ $lo_cus->customers_name }}</td>
                                                    <td>{{ $lo_cus->distance }} Km</td>
                                                    <td>{{ $lo_cus->type }}</td>
                                                    <td>{{ $lo_cus->amount }}</td>




                                                    <td>
                                                        @if ($lo_cus->status == '1')
                                                            <span class="badge bg-success">Active</span>
                                                        @elseif($lo_cus->status == '0')
                                                            <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>

                                                    <td style="min-width:110px; vertical-align: middle;">
                                                        <div class="accordion accordion-flush"
                                                            id="accordioncustomer{{ $lo_cus->id }}">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header"
                                                                    id="headingcustomer{{ $lo_cus->id }}">
                                                                    <button class="accordion-button collapsed p-1"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#collapsecustomer{{ $lo_cus->id }}"
                                                                        aria-expanded="false"
                                                                        aria-controls="collapsecustomer{{ $lo_cus->id }}">
                                                                        Actions
                                                                    </button>
                                                                </h2>

                                                                <div id="collapsecustomer{{ $lo_cus->id }}"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="headingcustomer{{ $lo_cus->id }}"
                                                                    data-bs-parent="#accordioncustomer{{ $lo_cus->id }}">

                                                                    <div class="accordion-body p-1">
                                                                        @include('masterfiles.components.edit_customers')
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
                                        {{ $customers_local->onEachSide(1)->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end card -->

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
