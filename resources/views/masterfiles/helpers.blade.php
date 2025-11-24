@extends('layouts.app')

@section('title', 'Helpers')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Helpers Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Helpers</li>
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

                            <!-- Add Helper Button & Search -->
                            <div class="row mb-3">

                                <!-- Add Helper Button -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-helper-modal">
                                        <i class="bi bi-plus-lg"></i> Add Helper
                                    </button>
                                </div>

                                <!-- Search Bar -->
                                <div class="col-md-6">
                                    <form action="{{ route('Masterfile.helpers') }}" method="get">
                                        <div class="input-group">
                                            <input type="search"
                                                   class="form-control"
                                                   name="searchKey"
                                                   placeholder="Helper Name or EPF Number"
                                                   value="{{ $searchKey ?? '' }}">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <!-- Add Helper Modal -->
                            <div class="p-1">
                                @include('masterfiles.components.add_helper')
                            </div>

                            <!-- Helpers Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>EPF Number</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th style="width: 120px;">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($helpers as $index => $helper)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $helper->name }}</td>
                                                <td>{{ $helper->epf_number }}</td>
                                                <td>{{ $helper->email }}</td>
                                                <td>{{ $helper->phone }}</td>
                                                <td>
                                                    <div class="accordion accordion-flush" id="accordionFlush{{ $helper->id }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-heading{{ $helper->id }}">
                                                                <button class="accordion-button collapsed"
                                                                        type="button"
                                                                        style="padding-top: unset; padding-bottom: unset;"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapse{{ $helper->id }}"
                                                                        aria-expanded="false"
                                                                        aria-controls="flush-collapse{{ $helper->id }}">
                                                                    Actions
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{ $helper->id }}"
                                                                 class="accordion-collapse collapse"
                                                                 aria-labelledby="flush-heading{{ $helper->id }}"
                                                                 data-bs-parent="#accordionFlush{{ $helper->id }}">
                                                                <div class="accordion-body" style="padding-top: 8px; padding-bottom: unset;">
                                                                    @include('masterfiles.components.edit_helper')
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
                                    {{$helpers->onEachSide(1)->links('pagination::bootstrap-5') }}
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