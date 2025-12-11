@extends('layouts.app')

@section('title', 'Userlevel')

@section('content')
    <main class="app-main">

        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Other Payments Master</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Other Payments</li>
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

                                <!-- Add userlevel Button -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-otherpayments-modal">
                                        <i class="bi bi-plus-lg"></i> Add Other Payments
                                    </button>
                                </div>

                                <!-- Search Bar -->
                                <div class="col-md-6">
                                    <form action="{{ route('Masterfile.otherpayments') }}" method="get">
                                        <div class="input-group">
                                            <input type="search"
                                                   class="form-control"
                                                   name="searchKey"
                                                   placeholder="Type"
                                                   value="{{ $searchKey ?? '' }}">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <!-- Add Userlevel Modal -->
                            <div class="p-1">
                                @include('masterfiles.components.add_otherpayments') 
                            </div>

                            <!-- Security Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Payment Type</th>
                                            <th>Driver</th>
                                            <th>Helper</th>
                                            <th style="width: 120px;">Actions</th>

                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($getotherpayments as $index => $otherpayments)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $otherpayments->payment_type }}</td>
                                                <td>{{ $otherpayments->driver_amount }}</td>
                                                <td>{{ $otherpayments->helper_amount }}</td>



                                                <td>
                                                    <div class="accordion accordion-flush"
                                                        id="accordionFlush{{ $otherpayments->id }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="flush-heading{{ $otherpayments->id }}">
                                                                <button class="accordion-button collapsed"
                                                                    type="button"
                                                                    style="padding-top: unset;padding-bottom: unset;"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapse{{ $otherpayments->id }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="flush-collapse{{ $otherpayments->id }}">
                                                                    Actions
                                                                </button>
                                                            </h2>

                                                            <div id="flush-collapse{{ $otherpayments->id }}"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="flush-heading{{ $otherpayments->id }}"
                                                                data-bs-parent="#accordionFlush{{ $otherpayments->id }}">
                                                                <div class="accordion-body"
                                                                    style="padding-top: 8px;padding-bottom: unset;">
                                                                    @include('masterfiles.components.edit_otherpayments')
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
                                    {{ $getotherpayments->onEachSide(1)->links('pagination::bootstrap-5') }}
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

<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach((form) => {
            form.addEventListener(
                'submit',
                (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                },
                false,
            );
        });
    })();
</script>

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
