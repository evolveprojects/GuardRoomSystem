@extends('layouts.app')

@section('title', 'Incentive Report')

@push('styles')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        .pagination-wrapper nav {
            display: inline-block;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
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
@endpush

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

                                    <!-- Search Input -->
                                    <div class="col-md-6">
                                        <input type="search" class="form-control" name="searchKey" placeholder="Level Name"
                                            value="{{ $searchKey ?? '' }}">
                                    </div>

                                    <!-- Date Range Search -->
                                    <div class="col-md-6">
                                        <form action="{{ route('Masterfile.userlevel') }}" method="get">
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker me-2" name="from"
                                                    placeholder="From Date" value="{{ request('from') }}">
                                                <input type="text" class="form-control datepicker me-2" name="to"
                                                    placeholder="To Date" value="{{ request('to') }}">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                                @php
                                    function ordinal($number)
                                    {
                                        if (!$number) {
                                            return '-';
                                        }
                                        $ends = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
                                        if ($number % 100 >= 11 && $number % 100 <= 13) {
                                            return $number . 'th';
                                        }
                                        return $number . $ends[$number % 10];
                                    }

                                    // Get all main IDs first
                                    $mainIds = $get_outward_data->pluck('id')->toArray();

                                    // Fetch all sub data at once (outside the loop for better performance)
                                    $all_sub_data = [];
                                    if (!empty($mainIds)) {
                                        $all_sub_data = DB::table('Outwardmodel_type1_t2s')
                                            ->whereIn('outward_id', $mainIds)
                                            ->leftJoin(
                                                'customers',
                                                'customers.customers',
                                                '=',
                                                'Outwardmodel_type1_t2s.customer_se',
                                            )
                                            ->select(
                                                'Outwardmodel_type1_t2s.*',
                                                'customers.customers_name',
                                                'customers.type',
                                                'customers.distance',
                                            )
                                            ->get()
                                            ->groupBy('outward_id');
                                    }
                                    $previous_date = null;
                                @endphp

                                <!-- Data Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped align-middle mb-0"
                                        style="width:250%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>AOD No</th>
                                                <th>Customer Names</th>
                                                <th>D/Trip</th>
                                                <th>Driver</th>
                                                <th>D/EPF No</th>
                                                <th>H/Trip</th>
                                                <th>Helper</th>
                                                <th>H/EPF NO</th>
                                                <th>Vehicle</th>
                                                <th>D Trip Fee</th>
                                                <th>H Trip Fee</th>
                                                <th>D Breakfast</th>
                                                <th>H Breakfast</th>
                                                <th>D Lunch</th>
                                                <th>H Lunch</th>
                                                <th>D Dinner</th>
                                                <th>H Dinner</th>
                                                <th>B.C./5MT</th>
                                                <th>Good Return</th>
                                                <th>D Night Allowance</th>
                                                <th>H Night Allowance</th>
                                                <th>Pallet</th>
                                                <th>Unload</th>
                                                <th>D Total</th>
                                                <th>H Total</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $grand_driver_total = 0;
                                                $grand_helper_total = 0;
                                            @endphp
                                            @forelse ($get_outward_data as $key => $data)
                                                @php

                                                    // $current_date = \Carbon\Carbon::parse($data->created_at)->format(
                                                    //     'Y-m-d',
                                                    // );

                                                    // if ($previous_date === $current_date) {
                                                    //     continue;
                                                    // }


                                                    $sub_items = $all_sub_data[$data->id] ?? collect([]);
                                                    $customer_names = $sub_items
                                                        ->pluck('customers_name')
                                                        ->filter()
                                                        ->implode('/ ');

                                                    // 1. Get all unique types
                                                    $all_types = $sub_items->pluck('type')->filter()->unique()->all();

                                                    // 2. Define priority (C > B > A). Add other types if needed.
                                                    $type_priority = ['C', 'B', 'A'];
                                                    $selected_type = null;

                                                    // 3. Find the highest-ranking type
                                                    foreach ($type_priority as $priority_type) {
                                                        if (in_array($priority_type, $all_types)) {
                                                            $selected_type = $priority_type;
                                                            break; // Found the highest priority type, stop searching
                                                        }
                                                    }

                                                    // Use the selected type for the lookup, or default to the original logic if no priority type is found (e.g., if you have other types like 'D', 'E', etc.)
                                                    $customer_type =
                                                        $selected_type ??
                                                        ($sub_items->pluck('type')->filter()->first() ?? null);
                                                    $customer_distance = $sub_items
                                                        ->pluck('distance')
                                                        ->filter()
                                                        ->implode('/ ');

                                                    $aod = $sub_items->pluck('aod_td')->filter()->implode('/ ');

                                                    $trip_no_d = $data->driver_trip_no ?? null;
                                                    $trip_no_h = $data->helper_trip_no ?? null;
                                                    $distance = intval($customer_distance ?? 0);

                                                    $weight = intval($data->weight ?? 0);

                                                    // Fetch driver amount
                                                    $trip_fee_driver = DB::table('payment_cons')
                                                        ->where('type', $customer_type)
                                                        ->where('trip', $trip_no_d)
                                                        ->where('km_min', '<=', $distance)
                                                        ->where('km_max', '>=', $distance)
                                                        ->where('weight_min', '<=', $weight)
                                                        ->where('weight_max', '>=', $weight)
                                                        ->value('driver_amount'); // returns single value

                                                    // Fetch helper amount
                                                    $trip_fee_helper = DB::table('payment_cons')
                                                        ->where('type', $customer_type)
                                                        ->where('trip', $trip_no_h)
                                                        ->where('km_min', '<=', $distance)
                                                        ->where('km_max', '>=', $distance)
                                                        ->where('weight_min', '<=', $weight)
                                                        ->where('weight_max', '>=', $weight)
                                                        ->value('helper_amount');

                                                    $lunch_hour = '13:00';
                                                    $d_lunch_payment = 0; // Initialize lunch payment

                                                    if (!empty($data->time_in) && !empty($data->time_out)) {
                                                        if (
                                                            $data->time_in >= $lunch_hour &&
                                                            $data->time_out <= $lunch_hour
                                                        ) {
                                                            $d_lunch_payment = DB::table('other_payments')
                                                                ->where('payment_type', 'Lunch')
                                                                ->value('driver_amount');
                                                        }
                                                    }

                                                    $d_lunch = $d_lunch_payment > 0 ? $d_lunch_payment : '-';

                                                    $h_lunch_payment = 0; // Initialize lunch payment

                                                    if (!empty($data->time_in) && !empty($data->time_out)) {
                                                        if (
                                                            $data->time_in >= $lunch_hour &&
                                                            $data->time_out <= $lunch_hour
                                                        ) {
                                                            $h_lunch_payment = DB::table('other_payments')
                                                                ->where('payment_type', 'Lunch')
                                                                ->value('helper_amount');
                                                        }
                                                    }

                                                    $h_lunch = $h_lunch_payment > 0 ? $h_lunch_payment : '-';

                                                    $break_hour = '8:00';
                                                    $d_break_payment = 0; // Initialize break payment

                                                    if (!empty($data->time_in) && !empty($data->time_out)) {
                                                        if (
                                                            $data->time_in >= $break_hour &&
                                                            $data->time_out <= $break_hour
                                                        ) {
                                                            $d_break_payment = DB::table('other_payments')
                                                                ->where('payment_type', 'Breakfast')
                                                                ->value('driver_amount');
                                                        }
                                                    }

                                                    $d_break = $d_break_payment > 0 ? $d_break_payment : '-';

                                                    $h_break_payment = 0; // Initialize break payment

                                                    if (!empty($data->time_in) && !empty($data->time_out)) {
                                                        if (
                                                            $data->time_in >= $break_hour &&
                                                            $data->time_out <= $break_hour
                                                        ) {
                                                            $h_break_payment = DB::table('other_payments')
                                                                ->where('payment_type', 'Breakfast')
                                                                ->value('helper_amount');
                                                        }
                                                    }

                                                    $h_break = $h_break_payment > 0 ? $h_break_payment : '-';

                                                    $dinner_hour = '20:00';
                                                    $d_dinner_payment = 0; // Initialize dinner payment

                                                    if (!empty($data->time_in) && !empty($data->time_out)) {
                                                        if (
                                                            $data->time_in >= $dinner_hour &&
                                                            $data->time_out <= $dinner_hour
                                                        ) {
                                                            $d_dinner_payment = DB::table('other_payments')
                                                                ->where('payment_type', 'Dinner')
                                                                ->value('driver_amount');
                                                        }
                                                    }

                                                    $d_dinner = $d_dinner_payment > 0 ? $d_dinner_payment : '-';

                                                    $h_dinner_payment = 0; // Initialize dinner payment

                                                    if (!empty($data->time_in) && !empty($data->time_out)) {
                                                        if (
                                                            $data->time_in >= $dinner_hour &&
                                                            $data->time_out <= $dinner_hour
                                                        ) {
                                                            $h_dinner_payment = DB::table('other_payments')
                                                                ->where('payment_type', 'Dinner')
                                                                ->value('helper_amount');
                                                        }
                                                    }

                                                    $h_dinner = $h_dinner_payment > 0 ? $h_dinner_payment : '-';

                                                    $night_hour = '00:00';
                                                    $d_night_payment = 0; // Initialize night payment

                                                    if (!empty($data->time_in) && !empty($data->time_out)) {
                                                        if (
                                                            $data->time_in >= $night_hour &&
                                                            $data->time_out <= $night_hour
                                                        ) {
                                                            $d_night_payment = DB::table('other_payments')
                                                                ->where('payment_type', 'Night allowance')
                                                                ->value('driver_amount');
                                                        }
                                                    }

                                                    $d_night = $d_night_payment > 0 ? $d_night_payment : '-';

                                                    $h_night_payment = 0; // Initialize night payment

                                                    if (!empty($data->time_in) && !empty($data->time_out)) {
                                                        if (
                                                            $data->time_in >= $night_hour &&
                                                            $data->time_out <= $night_hour
                                                        ) {
                                                            $h_night_payment = DB::table('other_payments')
                                                                ->where('payment_type', 'Night allowance')
                                                                ->value('helper_amount');
                                                        }
                                                    }

                                                    $h_night = $h_night_payment > 0 ? $h_night_payment : '-';

                                                    // Calculate Totals (ensure all components are treated as numbers for the sum)
                                                    // --- SAFE TOTAL CALCULATION ---
                                                    // --- Driver Total Calculation (d_total) ---

                                                    // Step 1: Clean the string variables by removing the thousand separator comma (',')
                                                    $trip_fee_driver_cleaned = str_replace(
                                                        ',',
                                                        '',
                                                        $trip_fee_driver ?? 0,
                                                    );
                                                    $d_break_payment_cleaned = str_replace(',', '', $d_break_payment);
                                                    $d_lunch_payment_cleaned = str_replace(',', '', $d_lunch_payment);
                                                    $d_dinner_payment_cleaned = str_replace(',', '', $d_dinner_payment);
                                                    $d_night_payment_cleaned = str_replace(',', '', $d_night_payment);

                                                    $d_total =
                                                        (float) $trip_fee_driver_cleaned +
                                                        (float) $d_break_payment_cleaned +
                                                        (float) $d_lunch_payment_cleaned +
                                                        (float) $d_dinner_payment_cleaned +
                                                        (float) $d_night_payment_cleaned;

                                                    // --- Helper Total Calculation (h_total) ---

                                                    // Step 2: Clean the string variables for the helper calculation
                                                    $trip_fee_helper_cleaned = str_replace(
                                                        ',',
                                                        '',
                                                        $trip_fee_helper ?? 0,
                                                    );
                                                    $h_break_payment_cleaned = str_replace(',', '', $h_break_payment);
                                                    $h_lunch_payment_cleaned = str_replace(',', '', $h_lunch_payment);
                                                    $h_dinner_payment_cleaned = str_replace(',', '', $h_dinner_payment);
                                                    $h_night_payment_cleaned = str_replace(',', '', $h_night_payment);

                                                    $h_total =
                                                        (float) $trip_fee_helper_cleaned +
                                                        (float) $h_break_payment_cleaned +
                                                        (float) $h_lunch_payment_cleaned +
                                                        (float) $h_dinner_payment_cleaned +
                                                        (float) $h_night_payment_cleaned;
                                                    // ------------------------------
                                                    $grand_driver_total += $d_total;
                                                    $grand_helper_total += $h_total;
                                                    // $previous_date = $current_date;
                                                @endphp

                                                {{-- Main Row --}}
                                                <tr class="table-primary" data-bs-toggle="collapse"
                                                    data-bs-target="#sub_{{ $data->id }}" style="cursor: pointer;">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                                                    <td>{{ $aod ?: '-' }}</td>
                                                    <td>{{ $customer_names ?: '-' }}</td>
                                                    <td>{{ ordinal($data->driver_trip_no ?? null) }}</td>
                                                    <td>{{ $data->d_name ?? '-' }}</td>
                                                    <td>{{ $data->d_epf ?? '-' }}</td>
                                                    <td>{{ ordinal($data->helper_trip_no ?? null) }}</td>
                                                    <td>{{ $data->h_name ?? '-' }}</td>
                                                    <td>{{ $data->h_epf ?? '-' }}</td>
                                                    <td>{{ $data->vehicle_no ?? '-' }}
                                                        {{ isset($data->v_type) ? "({$data->v_type})" : '' }}</td>
                                                    <td>{{ $trip_fee_driver ?? '-' }}</td>
                                                    <td>{{ $trip_fee_helper ?? '-' }}</td>
                                                    <td>{{ $d_break ?? '-' }}</td>
                                                    <td>{{ $h_break ?? '-' }}</td>
                                                    <td>{{ $d_lunch ?? '-' }}</td>
                                                    <td>{{ $h_lunch ?? '-' }}</td>
                                                    <td>{{ $d_dinner ?? '-' }}</td>
                                                    <td>{{ $h_dinner ?? '-' }}</td>

                                                    <td>{{ $data->bc_5mt ?? '-' }}</td>
                                                    <td>{{ $data->good_return ?? '-' }}</td>
                                                    <td>{{ $d_night ?? '-' }}</td>
                                                    <td>{{ $h_night ?? '-' }}</td>
                                                    <td>{{ $data->pallet ?? '-' }}</td>
                                                    <td>{{ $data->unload ?? '-' }}</td>
                                                    <td>{{ number_format($d_total, 2, '.', ',') ?? '-' }}</td>
                                                    <td>{{ number_format($h_total, 2, '.', ',') ?? '-' }}</td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="21" class="text-center">No data available</td>
                                                </tr>
                                            @endforelse
                                              <tr class="table-success fw-bold">

                                                    <td colspan="25" class="text-end">Grand Total</td>
                                                    <td>{{ number_format($grand_driver_total, 2, '.', ',') }}</td>
                                                    <td>{{ number_format($grand_helper_total, 2, '.', ',') }}</td>
                                                </tr>
                                        </tbody>

                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-end mt-4">
                                    <div class="pagination-wrapper">
                                        @if (method_exists($get_outward_data, 'links'))
                                            {{ $get_outward_data->onEachSide(1)->links('pagination::bootstrap-5') }}
                                        @endif
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

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize datepicker
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });

            // Form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach((form) => {
                form.addEventListener('submit', (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
    </script>
@endpush
