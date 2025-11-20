@extends('layouts.app')

@section('title', 'Security')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Security Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Security</li>
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

                            <div class="row mb-3">

                                <!-- Add Security Button -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-security-modal">
                                        <i class="bi bi-plus-lg"></i> Add Security
                                    </button>
                                </div>

                                <!-- Search Bar -->
                                <div class="col-md-6">
                                    <form action="{{ route('Masterfile.securities') }}" method="get">
                                        <div class="input-group">
                                            <input type="search"
                                                   class="form-control"
                                                   name="searchKey"
                                                   placeholder="Security Name"
                                                   value="{{ $searchKey ?? '' }}">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <!-- Add Security Modal -->
                            <div class="p-3">
                                @include('masterfiles.components.add_security') 
                            </div>

                            <!-- Security Table -->
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
                                        @foreach($securities as $index => $security)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $security->name }}</td>
                                                <td>{{ $security->epf_number }}</td>
                                                <td>{{ $security->email }}</td>
                                                <td>{{ $security->phone }}</td>
                                                <td>
                                                    <div class="accordion accordion-flush" id="accordionFlush{{ $security->id }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-heading{{ $security->id }}">
                                                                <button class="accordion-button collapsed"
                                                                        type="button"
                                                                        style="padding-top: unset; padding-bottom: unset;"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapse{{ $security->id }}"
                                                                        aria-expanded="false"
                                                                        aria-controls="flush-collapse{{ $security->id }}">
                                                                    Actions
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{ $security->id }}"
                                                                 class="accordion-collapse collapse"
                                                                 aria-labelledby="flush-heading{{ $security->id }}"
                                                                 data-bs-parent="#accordionFlush{{ $security->id }}">
                                                                <div class="accordion-body" style="padding-top: 8px; padding-bottom: unset;">
                                                                    @include('masterfiles.components.edit_security')
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

                        </div>
                    </div>
                    <!-- End Card -->

                    <!-- Pagination -->
                    <div class="card-footer clearfix">
                        <div class="d-flex justify-content-center">
                            {{ $securities->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>
@endsection
