@extends('layouts.app')

@section('title', 'Incentive Report')

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

        .export-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .export-btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .toast {
            z-index: 9999 !important;
        }

        /* Datepicker Styles - Fixed */
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
        .datepicker table tr td.active:hover,
        .datepicker table tr td.active.highlighted {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
            color: #fff !important;
        }

        .datepicker table tr td.today,
        .datepicker table tr td.today:hover {
            background-color: #ffc107 !important;
            color: #000 !important;
        }

        .datepicker table tr td.day:hover {
            background-color: #e9ecef;
            cursor: pointer;
        }

        /* Make input clickable */
        .datepicker-input {
            background-color: #fff !important;
            cursor: pointer;
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
                        <h3 class="mb-0">Lorry Usage Details Report</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Lorry Usage Details Report</li>
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
                                    <!-- Date Range Search -->
                                    <!-- Date Range Search -->
                                    <div class="col-md-6">
                                        <form action="{{ route('report.report_lorryusage_detail') }}" method="get"
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
                                        style="width:120%;" id="incentiveTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>OUT No</th>
                                                <th>AOD No</th>
                                                <th>Lorry No</th>
                                                <th>Max Weight</th>
                                                <th>Customer Names</th>
                                                <th>Weight(MT)</th>
                                                <th>Out Time</th>
                                                <th>In time</th>
                                                <th>Weight(MT)</th>
                                                <th>No of trips</th>


                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $grand_driver_total = 0;
                                                $grand_helper_total = 0;
                                            @endphp
                                            @forelse ($get_outward_data as $key => $data)
                                                @php
                                                    $sub_items = $all_sub_data[$data->id] ?? collect([]);
                                                    $customer_names = $sub_items
                                                        ->pluck('customers_name')
                                                        ->filter()
                                                        ->implode('/ ');

                                                    $aod = $sub_items->pluck('aod_td')->filter()->implode('/ ');

                                                @endphp

                                                {{-- Main Row --}}
                                                <tr class="table-primary" data-bs-toggle="collapse"
                                                    data-bs-target="#sub_{{ $data->id }}" style="cursor: pointer;">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                                                    <td>{{ $data->outward_number ?? '-' }}</td>
                                                    <td>{{ $aod ?: '-' }}</td>

                                                    <td>{{ $data->vehicle_no ?? '-' }}
                                                        {{ isset($data->v_type) ? "({$data->v_type})" : '' }}</td>
                                                    <td>{{ $data->max_weight ?? '-' }}</td>
                                                    <td>{{ $customer_names ?: '-' }}</td>
                                                     <td>{{ $data->Weight ?? '-' }}</td>
                                                     <td>{{ $data->time_out?? '-' }}</td>
                                                     <td>{{ $data->time_in ?? '-' }}</td>
                                                     <td>{{ $data->Weight ?? '-' }}</td>
                                                    <td>{{ ordinal($data->vehicle_trip_no ?? null) }}</td>



                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="12" class="text-center">No data available</td>
                                                </tr>
                                            @endforelse

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
    <!-- Excel export library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <!-- PDF export library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <!-- FileSaver -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script>
        $(document).ready(function() {
            console.log('jQuery version:', $.fn.jquery);
            console.log('Datepicker available:', typeof $.fn.datepicker !== 'undefined');

            // Initialize FROM date picker
            $('#fromDate').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                todayBtn: 'linked',
                clearBtn: true,
                orientation: 'bottom auto',
                endDate: new Date(),
                templates: {
                    leftArrow: '<i class="bi bi-chevron-left"></i>',
                    rightArrow: '<i class="bi bi-chevron-right"></i>'
                }
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
                startDate: $('#fromDate').val() ? new Date($('#fromDate').val()) : null,
                templates: {
                    leftArrow: '<i class="bi bi-chevron-left"></i>',
                    rightArrow: '<i class="bi bi-chevron-right"></i>'
                }
            });

            // If there's already a from date value
            if ($('#fromDate').val()) {
                $('#toDate').datepicker('setStartDate', new Date($('#fromDate').val()));
            }

            // Calendar icon click
            $('.input-group-text').on('click', function() {
                $(this).next('input.datepicker-input').datepicker('show');
            });

            // Reset dates button
            $('#resetDates').on('click', function() {
                $('#fromDate').val('').datepicker('update');
                $('#toDate').val('').datepicker('update').datepicker('setStartDate', null);
                window.location.href = window.location.pathname;
            });

            // Form validation
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

            // Export buttons
            $('#exportExcelBtn').on('click', exportTableToExcel);
            $('#exportPdfBtn').on('click', exportTableToPDF);
            $('#exportCsvBtn').on('click', exportTableToCSV);
        });

        // ========== EXPORT FUNCTIONS ==========
        function exportTableToExcel() {
            try {
                showToast('Preparing Excel file...', 'info');
                const table = document.getElementById('incentiveTable');
                if (!table) {
                    showToast('Table not found!', 'error');
                    return;
                }

                const tableClone = table.cloneNode(true);
                $(tableClone).find('tr[data-bs-toggle="collapse"]').removeAttr('data-bs-toggle data-bs-target style');
                $(tableClone).find('tr.collapse').remove();

                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.table_to_sheet(tableClone);
                XLSX.utils.book_append_sheet(wb, ws, "Lorry Usage Detail Report");

                const date = new Date().toISOString().split('T')[0];
                XLSX.writeFile(wb, `Lorry_Usage_Detail_Report_${date}.xlsx`);
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
                if (!table) {
                    showToast('Table not found!', 'error');
                    return;
                }

                const rows = table.querySelectorAll('tr');
                const csv = [];
                rows.forEach(row => {
                    const rowData = [];
                    row.querySelectorAll('td, th').forEach(cell => {
                        let data = cell.innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/\s+/g, ' ').trim();
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
                link.download = `Lorry_Usage_Detail_Report_${new Date().toISOString().split('T')[0]}.csv`;
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
                doc.text('Lorry Usage Detail Report', 14, 15);
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
                        fontSize: 6,
                        cellPadding: 1
                    },
                    headStyles: {
                        fillColor: [13, 110, 253],
                        fontSize: 7
                    },
                    margin: {
                        left: 5,
                        right: 5
                    }
                });

                doc.save(`Lorry_Usage_Detail_Report_${new Date().toISOString().split('T')[0]}.pdf`);
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
