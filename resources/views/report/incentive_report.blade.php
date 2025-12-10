<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


@extends('layouts.app')

@section('title', 'Userlevel')

@section('content')
    <main class="app-main">

        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Incentive Report</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Incentive Report</li>
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
                                    <div class="col-md-6 ">
                                        <input type="search" class="form-control" name="searchKey" placeholder="Level Name"
                                            value="{{ $searchKey ?? '' }}">
                                    </div>

                                    <!-- Search Bar -->
                                    <div class="col-md-6">
                                        <form action="{{ route('Masterfile.userlevel') }}" method="get">
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker mr-2" name="from"
                                                    placeholder="From Date">
                                                <input type="text" class="form-control datepicker" name="to"
                                                    placeholder="To Date">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>

                                        </form>
                                    </div>

                                </div>


                                <!-- Security Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped align-middle mb-0 " style="width:160%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Trip</th>
                                                <th>Customer Name</th>
                                                <th>Trip</th>
                                                <th>Driver</th>
                                                <th>D/EPF No</th>
                                                <th>Helper</th>
                                                <th>H/EPF NO</th>
                                                <th>Breakfast</th>
                                                <th>Lunch</th>
                                                <th>Dinner</th>
                                                <th>Trip Fee</th>
                                                <th>B.C./5MT</th>
                                                <th>Good Return</th>
                                                <th>Night Allowance</th>
                                                <th>Pallet</th>
                                                <th>Unload</th>
                                                <th>Total</th>
                                                \
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($getuserlevels as $index => $userl)
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-end mt-4">
                                    <div class="pagination-wrapper">
                                        {{ $getuserlevels->onEachSide(1)->links('pagination::bootstrap-5') }}
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
<script>
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
</script>

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
