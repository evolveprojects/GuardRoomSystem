@extends('layouts.app')

@section('title', 'Incentive Summary Report')

@push('styles')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css">
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

        .toast {
            z-index: 9999 !important;
        }

        .datepicker {
            z-index: 1055 !important;
        }

        .datepicker-dropdown {
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .datepicker table tr td,
        .datepicker table tr th {
            border-radius: 4px;
            width: 35px;
            height: 35px;
        }

        .datepicker table tr td.active,
        .datepicker table tr td.active:hover {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            color: #fff !important;
        }

        .datepicker table tr td.today {
            background-color: #ffc107 !important;
            color: #000 !important;
        }

        .datepicker-input {
            background-color: #fff !important;
            cursor: pointer;
        }

        .summary-card {
            border-left: 4px solid;
            margin-bottom: 20px;
        }

        .driver-card {
            border-left-color: #0d6efd;
        }

        .helper-card {
            border-left-color: #198754;
        }

        .date-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-weight: 600;
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
                        <h3 class="mb-0">Incentive Summary Report</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Incentive Summary</li>
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

                                    <!-- Export Buttons -->
                                    <div class="col-md-6">
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-success" id="exportExcelBtn">
                                                <i class="bi bi-file-earmark-excel"></i> Export to Excel
                                            </button>
                                            <button type="button" class="btn btn-danger" id="exportPdfBtn">
                                                <i class="bi bi-file-earmark-pdf"></i> Export to PDF
                                            </button>
                                            <button type="button" class="btn btn-info" id="exportCsvBtn">
                                                <i class="bi bi-filetype-csv"></i> Export to CSV
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Date Range Search -->
                                    <div class="col-md-6">
                                        <form action="{{ route('report.report_intencive_summary') }}" method="get"
                                            id="dateFilterForm">
                                            <div class="input-group">
                                                <span class="input-group-text" style="cursor: pointer;">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                                <input type="text" class="form-control datepicker-input" name="from"
                                                    placeholder="From Date (YYYY-MM-DD)" value="{{ request('from') }}"
                                                    id="fromDate" autocomplete="off">

                                                <span class="input-group-text" style="cursor: pointer;">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                                <input type="text" class="form-control datepicker-input" name="to"
                                                    placeholder="To Date (YYYY-MM-DD)" value="{{ request('to') }}"
                                                    id="toDate" autocomplete="off">

                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-search"></i> Search
                                                </button>
                                                <button type="button" class="btn btn-secondary" id="resetDates">
                                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                                @php
                                    // Get all main IDs first
                                    $mainIds = $get_outward_data->pluck('id')->toArray();

                                    // Fetch all sub data at once
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

                                    // Helper function to clean and convert to float
                                    function cleanNumber($value)
                                    {
                                        if (empty($value) || $value === null || $value === '-') {
                                            return 0;
                                        }
                                        // Remove commas and any other non-numeric characters except decimal point and minus
                                        $cleaned = preg_replace('/[^0-9.\-]/', '', str_replace(',', '', $value));
                                        return (float) $cleaned;
                                    }

                                    // Initialize summary arrays
                                    $driver_daily_summary = [];
                                    $helper_daily_summary = [];

                                    foreach ($get_outward_data as $data) {
                                        $date = \Carbon\Carbon::parse($data->created_at)->format('Y-m-d');
                                        $date_formatted = \Carbon\Carbon::parse($data->created_at)->format('d-m-Y');

                                        $sub_items = $all_sub_data[$data->id] ?? collect([]);

                                        // Get customer type with priority
                                        $all_types = $sub_items->pluck('type')->filter()->unique()->all();
                                        $type_priority = ['C', 'B', 'A'];
                                        $selected_type = null;
                                        foreach ($type_priority as $priority_type) {
                                            if (in_array($priority_type, $all_types)) {
                                                $selected_type = $priority_type;
                                                break;
                                            }
                                        }
                                        $customer_type =
                                            $selected_type ?? ($sub_items->pluck('type')->filter()->first() ?? null);
                                        $customer_distance = $sub_items->pluck('distance')->filter()->first() ?? 0;

                                        $trip_no_d = $data->driver_trip_no ?? null;
                                        $trip_no_h = $data->helper_trip_no ?? null;
                                        $distance = intval($customer_distance);
                                        $weight = intval($data->weight ?? 0);

                                        // Fetch driver trip fee
                                        $trip_fee_driver_raw = DB::table('payment_cons')
                                            ->where('type', $customer_type)
                                            ->where('trip', $trip_no_d)
                                            ->where('km_min', '<=', $distance)
                                            ->where('km_max', '>=', $distance)
                                            ->where('weight_min', '<=', $weight)
                                            ->where('weight_max', '>=', $weight)
                                            ->value('driver_amount');
                                        $trip_fee_driver = cleanNumber($trip_fee_driver_raw);

                                        // Fetch helper trip fee
                                        $trip_fee_helper_raw = DB::table('payment_cons')
                                            ->where('type', $customer_type)
                                            ->where('trip', $trip_no_h)
                                            ->where('km_min', '<=', $distance)
                                            ->where('km_max', '>=', $distance)
                                            ->where('weight_min', '<=', $weight)
                                            ->where('weight_max', '>=', $weight)
                                            ->value('helper_amount');
                                        $trip_fee_helper = cleanNumber($trip_fee_helper_raw);

                                        // Calculate meal payments
                                        $d_lunch_payment = 0;
                                        $h_lunch_payment = 0;
                                        $d_break_payment = 0;
                                        $h_break_payment = 0;
                                        $d_dinner_payment = 0;
                                        $h_dinner_payment = 0;
                                        $d_night_payment = 0;
                                        $h_night_payment = 0;

                                        if (!empty($data->time_in) && !empty($data->time_out)) {
                                            if ($data->time_in >= '13:00' && $data->time_out <= '13:00') {
                                                $d_lunch_payment = cleanNumber(
                                                    DB::table('other_payments')
                                                        ->where('payment_type', 'Lunch')
                                                        ->value('driver_amount'),
                                                );
                                                $h_lunch_payment = cleanNumber(
                                                    DB::table('other_payments')
                                                        ->where('payment_type', 'Lunch')
                                                        ->value('helper_amount'),
                                                );
                                            }
                                            if ($data->time_in >= '8:00' && $data->time_out <= '8:00') {
                                                $d_break_payment = cleanNumber(
                                                    DB::table('other_payments')
                                                        ->where('payment_type', 'Breakfast')
                                                        ->value('driver_amount'),
                                                );
                                                $h_break_payment = cleanNumber(
                                                    DB::table('other_payments')
                                                        ->where('payment_type', 'Breakfast')
                                                        ->value('helper_amount'),
                                                );
                                            }
                                            if ($data->time_in >= '20:00' && $data->time_out <= '20:00') {
                                                $d_dinner_payment = cleanNumber(
                                                    DB::table('other_payments')
                                                        ->where('payment_type', 'Dinner')
                                                        ->value('driver_amount'),
                                                );
                                                $h_dinner_payment = cleanNumber(
                                                    DB::table('other_payments')
                                                        ->where('payment_type', 'Dinner')
                                                        ->value('helper_amount'),
                                                );
                                            }
                                            if ($data->time_in >= '00:00' && $data->time_out <= '00:00') {
                                                $d_night_payment = cleanNumber(
                                                    DB::table('other_payments')
                                                        ->where('payment_type', 'Night allowance')
                                                        ->value('driver_amount'),
                                                );
                                                $h_night_payment = cleanNumber(
                                                    DB::table('other_payments')
                                                        ->where('payment_type', 'Night allowance')
                                                        ->value('helper_amount'),
                                                );
                                            }
                                        }

                                        // Calculate other payments from inward_items
                                        $d_ballclay_payment = 0;
                                        $h_ballclay_payment = 0;
                                        $d_goodru_payment = 0;
                                        $h_goodru_payment = 0;
                                        $d_pallet_payment = 0;
                                        $h_pallet_payment = 0;
                                        $d_unload_payment = 0;
                                        $h_unload_payment = 0;

                                        if (!empty($data->inward_items)) {
                                            $inward_items_array = array_map(
                                                'trim',
                                                explode(',', trim($data->inward_items)),
                                            );

                                            if (in_array('5', $inward_items_array)) {
                                                $d_ballclay_payment = cleanNumber(
                                                    DB::table('other_payments')->where('id', 5)->value('driver_amount'),
                                                );
                                                $h_ballclay_payment = cleanNumber(
                                                    DB::table('other_payments')->where('id', 5)->value('helper_amount'),
                                                );
                                            }
                                            if (in_array('6', $inward_items_array)) {
                                                $d_goodru_payment = cleanNumber(
                                                    DB::table('other_payments')->where('id', 6)->value('driver_amount'),
                                                );
                                                $h_goodru_payment = cleanNumber(
                                                    DB::table('other_payments')->where('id', 6)->value('helper_amount'),
                                                );
                                            }
                                            if (in_array('8', $inward_items_array)) {
                                                $d_pallet_payment = cleanNumber(
                                                    DB::table('other_payments')->where('id', 8)->value('driver_amount'),
                                                );
                                                $h_pallet_payment = cleanNumber(
                                                    DB::table('other_payments')->where('id', 8)->value('helper_amount'),
                                                );
                                            }
                                            if (in_array('9', $inward_items_array)) {
                                                $d_unload_payment = cleanNumber(
                                                    DB::table('other_payments')->where('id', 9)->value('driver_amount'),
                                                );
                                                $h_unload_payment = cleanNumber(
                                                    DB::table('other_payments')->where('id', 9)->value('helper_amount'),
                                                );
                                            }
                                        }

                                        // Calculate totals - all values are already cleaned floats
                                        $d_total =
                                            $trip_fee_driver +
                                            $d_break_payment +
                                            $d_lunch_payment +
                                            $d_dinner_payment +
                                            $d_ballclay_payment +
                                            $d_pallet_payment +
                                            $d_goodru_payment +
                                            $d_unload_payment +
                                            $d_night_payment;

                                        $h_total =
                                            $trip_fee_helper +
                                            $h_break_payment +
                                            $h_lunch_payment +
                                            $h_dinner_payment +
                                            $h_ballclay_payment +
                                            $h_pallet_payment +
                                            $h_goodru_payment +
                                            $h_unload_payment +
                                            $h_night_payment;

                                        // Build driver daily summary
                                        $driver_key = $date . '_' . $data->driver;
                                        if (!isset($driver_daily_summary[$driver_key])) {
                                            $driver_daily_summary[$driver_key] = [
                                                'date' => $date,
                                                'date_formatted' => $date_formatted,
                                                'name' => $data->d_name ?? '-',
                                                'epf' => $data->d_epf ?? '-',
                                                'total' => 0,
                                            ];
                                        }
                                        $driver_daily_summary[$driver_key]['total'] += $d_total;

                                        // Build helper daily summary
                                        $helper_key = $date . '_' . $data->helper;
                                        if (!isset($helper_daily_summary[$helper_key])) {
                                            $helper_daily_summary[$helper_key] = [
                                                'date' => $date,
                                                'date_formatted' => $date_formatted,
                                                'name' => $data->h_name ?? '-',
                                                'epf' => $data->h_epf ?? '-',
                                                'total' => 0,
                                            ];
                                        }
                                        $helper_daily_summary[$helper_key]['total'] += $h_total;
                                    }

                                    // Sort by date descending
                                    usort($driver_daily_summary, function ($a, $b) {
                                        return strcmp($b['date'], $a['date']);
                                    });
                                    usort($helper_daily_summary, function ($a, $b) {
                                        return strcmp($b['date'], $a['date']);
                                    });

                                    // Calculate grand totals
                                    $grand_driver_total = array_sum(array_column($driver_daily_summary, 'total'));
                                    $grand_helper_total = array_sum(array_column($helper_daily_summary, 'total'));
                                @endphp

                                <!-- Summary Cards -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="card bg-primary text-white">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Total Driver Incentives</h5>
                                                <h2 class="mb-0">{{ number_format($grand_driver_total, 2) }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card bg-success text-white">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Total Helper Incentives</h5>
                                                <h2 class="mb-0">{{ number_format($grand_helper_total, 2) }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Driver Summary Table -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm summary-card driver-card">
                                            <div class="card-header bg-primary text-white">
                                                <h5 class="mb-0"><i class="bi bi-person-badge"></i> Driver Daily Summary
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover table-striped mb-0"
                                                        id="driverSummaryTable">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Date</th>
                                                                <th>Driver Name</th>
                                                                <th>EPF No</th>
                                                                <th class="text-end">Daily Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($driver_daily_summary as $index => $driver)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $driver['date_formatted'] }}</td>
                                                                    <td>{{ $driver['name'] }}</td>
                                                                    <td>{{ $driver['epf'] }}</td>
                                                                    <td class="text-end fw-bold">
                                                                        {{ number_format($driver['total'], 2) }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center">No data
                                                                        available</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                        <tfoot class="table-primary">
                                                            <tr class="fw-bold">
                                                                <td colspan="4" class="text-end">Grand Total:</td>
                                                                <td class="text-end">
                                                                    {{ number_format($grand_driver_total, 2) }}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Helper Summary Table -->
                                    <div class="col-md-6">
                                        <div class="card shadow-sm summary-card helper-card">
                                            <div class="card-header bg-success text-white">
                                                <h5 class="mb-0"><i class="bi bi-person-badge"></i> Helper Daily Summary
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover table-striped mb-0"
                                                        id="helperSummaryTable">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Date</th>
                                                                <th>Helper Name</th>
                                                                <th>EPF No</th>
                                                                <th class="text-end">Daily Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($helper_daily_summary as $index => $helper)
                                                                <tr>
                                                                    <td>{{ $index + 1 }}</td>
                                                                    <td>{{ $helper['date_formatted'] }}</td>
                                                                    <td>{{ $helper['name'] }}</td>
                                                                    <td>{{ $helper['epf'] }}</td>
                                                                    <td class="text-end fw-bold">
                                                                        {{ number_format($helper['total'], 2) }}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center">No data
                                                                        available</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                        <tfoot class="table-success">
                                                            <tr class="fw-bold">
                                                                <td colspan="4" class="text-end">Grand Total:</td>
                                                                <td class="text-end">
                                                                    {{ number_format($grand_helper_total, 2) }}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Combined Summary Table (for export) -->
                                <div class="card shadow-sm mt-4">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="mb-0"><i class="bi bi-table"></i> Combined Summary (For Export)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped mb-0"
                                                id="incentiveTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Driver Name</th>
                                                        <th>Driver EPF</th>
                                                        <th class="text-end">Driver Daily Total</th>
                                                        <th>Helper Name</th>
                                                        <th>Helper EPF</th>
                                                        <th class="text-end">Helper Daily Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $max_rows = max(
                                                            count($driver_daily_summary),
                                                            count($helper_daily_summary),
                                                        );
                                                        $driver_arr = array_values($driver_daily_summary);
                                                        $helper_arr = array_values($helper_daily_summary);
                                                    @endphp
                                                    @for ($i = 0; $i < $max_rows; $i++)
                                                        <tr>
                                                            <td>{{ $i + 1 }}</td>
                                                            <td>{{ $driver_arr[$i]['date_formatted'] ?? ($helper_arr[$i]['date_formatted'] ?? '-') }}
                                                            </td>
                                                            <td>{{ $driver_arr[$i]['name'] ?? '-' }}</td>
                                                            <td>{{ $driver_arr[$i]['epf'] ?? '-' }}</td>
                                                            <td class="text-end">
                                                                {{ isset($driver_arr[$i]) ? number_format($driver_arr[$i]['total'], 2) : '-' }}
                                                            </td>
                                                            <td>{{ $helper_arr[$i]['name'] ?? '-' }}</td>
                                                            <td>{{ $helper_arr[$i]['epf'] ?? '-' }}</td>
                                                            <td class="text-end">
                                                                {{ isset($helper_arr[$i]) ? number_format($helper_arr[$i]['total'], 2) : '-' }}
                                                            </td>
                                                        </tr>
                                                    @endfor
                                                </tbody>
                                                <tfoot class="table-dark">
                                                    <tr class="fw-bold">
                                                        <td colspan="4" class="text-end">Grand Totals:</td>
                                                        <td class="text-end">{{ number_format($grand_driver_total, 2) }}
                                                        </td>
                                                        <td colspan="2"></td>
                                                        <td class="text-end">{{ number_format($grand_helper_total, 2) }}
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize FROM date picker
            $('#fromDate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                todayBtn: 'linked',
                clearBtn: true,
                orientation: 'bottom auto',
                endDate: new Date()
            }).on('changeDate', function(e) {
                var fromDate = $('#fromDate').datepicker('getDate');
                if (fromDate) {
                    $('#toDate').datepicker('setStartDate', fromDate);
                }
            });

            // Initialize TO date picker
            $('#toDate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                todayBtn: 'linked',
                clearBtn: true,
                orientation: 'bottom auto',
                endDate: new Date(),
                startDate: $('#fromDate').val() ? new Date($('#fromDate').val()) : null
            });

            if ($('#fromDate').val()) {
                $('#toDate').datepicker('setStartDate', new Date($('#fromDate').val()));
            }

            $('.input-group-text').on('click', function() {
                $(this).next('input.datepicker-input').datepicker('show');
            });

            $('#resetDates').on('click', function() {
                $('#fromDate').val('').datepicker('update');
                $('#toDate').val('').datepicker('update').datepicker('setStartDate', null);
                window.location.href = window.location.pathname;
            });

            $('#dateFilterForm').on('submit', function(e) {
                var fromDate = $('#fromDate').val();
                var toDate = $('#toDate').val();
                if (fromDate && toDate) {
                    if (new Date(fromDate) > new Date(toDate)) {
                        e.preventDefault();
                        showToast('From date cannot be greater than To date', 'error');
                        return false;
                    }
                }
            });

            $('#exportExcelBtn').on('click', exportTableToExcel);
            $('#exportPdfBtn').on('click', exportTableToPDF);
            $('#exportCsvBtn').on('click', exportTableToCSV);
        });

        function exportTableToExcel() {
            try {
                showToast('Preparing Excel file...', 'info');
                const table = document.getElementById('incentiveTable');
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.table_to_sheet(table);
                XLSX.utils.book_append_sheet(wb, ws, "Incentive Summary");
                const date = new Date().toISOString().split('T')[0];
                XLSX.writeFile(wb, `Incentive_Summary_${date}.xlsx`);
                showToast('Excel file downloaded successfully!', 'success');
            } catch (error) {
                console.error('Error:', error);
                showToast('Error exporting to Excel', 'error');
            }
        }

        function exportTableToCSV() {
            try {
                showToast('Preparing CSV file...', 'info');
                const table = document.getElementById('incentiveTable');
                const rows = table.querySelectorAll('tr');
                const csv = [];
                rows.forEach(row => {
                    const rowData = [];
                    row.querySelectorAll('td, th').forEach(cell => {
                        let data = cell.innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/\s+/g, ' ')
                            .trim();
                        if (data.includes(',') || data.includes('"')) {
                            data = '"' + data.replace(/"/g, '""') + '"';
                        }
                        rowData.push(data);
                    });
                    csv.push(rowData.join(','));
                });

                const blob = new Blob(['\ufeff' + csv.join('\n')], {
                    type: 'text/csv;charset=utf-8;'
                });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `Incentive_Summary_${new Date().toISOString().split('T')[0]}.csv`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                showToast('CSV file downloaded successfully!', 'success');
            } catch (error) {
                console.error('Error:', error);
                showToast('Error exporting to CSV', 'error');
            }
        }

        function exportTableToPDF() {
            try {
                showToast('Preparing PDF file...', 'info');
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF({
                    orientation: 'landscape',
                    unit: 'mm',
                    format: 'a4'
                });

                doc.setFontSize(16);
                doc.text('Incentive Summary Report', 14, 15);
                doc.setFontSize(10);
                doc.text(`Generated on: ${new Date().toLocaleDateString()}`, 14, 22);

                const table = document.getElementById('incentiveTable');
                const headers = [];
                const data = [];

                table.querySelectorAll('thead th').forEach(cell => headers.push(cell.innerText));
                table.querySelectorAll('tbody tr').forEach(row => {
                    const rowData = [];
                    row.querySelectorAll('td').forEach(cell => rowData.push(cell.innerText));
                    if (rowData.length > 0) data.push(rowData);
                });

                doc.autoTable({
                    head: [headers],
                    body: data,
                    startY: 30,
                    theme: 'grid',
                    styles: {
                        fontSize: 8,
                        cellPadding: 2
                    },
                    headStyles: {
                        fillColor: [13, 110, 253],
                        fontSize: 9
                    }
                });

                doc.save(`Incentive_Summary_${new Date().toISOString().split('T')[0]}.pdf`);
                showToast('PDF file downloaded successfully!', 'success');
            } catch (error) {
                console.error('Error:', error);
                showToast('Error exporting to PDF', 'error');
            }
        }

        function showToast(message, type = 'info') {
            $('.toast').remove();
            const toastClass = {
                'success': 'bg-success',
                'error': 'bg-danger',
                'info': 'bg-info',
                'warning': 'bg-warning'
            } [type] || 'bg-info';
            const toastId = 'toast-' + Date.now();
            const toast = `
                <div id="${toastId}" class="toast align-items-center text-white ${toastClass} border-0 position-fixed bottom-0 end-0 m-3" role="alert" style="z-index: 9999;">
                    <div class="d-flex">
                        <div class="toast-body">${message}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>`;
            $('body').append(toast);
            const toastElement = new bootstrap.Toast(document.getElementById(toastId));
            toastElement.show();
            setTimeout(() => toastElement.hide(), 3000);
        }
    </script>
@endpush
