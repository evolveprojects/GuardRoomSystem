@extends('layouts.app')

@section('title', 'Inward')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Inward Module</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Inward Module</li>
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
                            <div class="col-md-6 d-flex align-items-center mb-3">
                                <a href="{{ route('inward.inward_view_All') }}">
                                    <button class="btn btn-primary" type="button">
                                        <i class="bi bi-chevron-left"></i> All Inwards
                                    </button>
                                </a>
                            </div>

                            <form action="{{ route('inward.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <!-- Inward No -->
                                    <div class="col-sm-3 mb-3">
                                        <div class="form-group-sm">
                                            <label>Inward NO <span class="text-danger">*</span></label>
                                            <input type="text" name="inward_no" value="{{ $inward_no }}" class="form-control" readonly style="height:30px;">
                                        </div>
                                    </div>

                                    <!-- Center -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Center <span class="text-danger">*</span></label>
                                            <select name="center" id="center" class="form-control selectize" required>
                                                <option value="">Select Center:</option>
                                                @foreach($centers as $c)
                                                    <option value="{{ $c->id }}">{{ $c->center_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Type -->
                                    <div class="col-sm-3 mb-3">
                                        <div class="form-group-sm">
                                            <label for="type">Type <span class="text-danger">*</span></label>
                                            <select id="type" name="type" class="form-control selectize" style="height:30px;" required>
                                                <option value="">Select Type</option>
                                                <option value="Supplier">Supplier</option>
                                                <option value="Raw Material">Raw Material</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Vehicle No -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Vehicle No <span class="text-danger">*</span></label>
                                            <select name="vehicle_id" id="vehicle_no" required onchange="getvehicle_type()" class="form-control selectize">
                                                <option value="">Select Vehicle No:</option>
                                                @foreach ($vehicles as $v)
                                                    <option value="{{ $v->id }}">{{ $v->vehicle_no }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Date -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Date <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" class="form-control date-picker" style="height:30px;" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Driver -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Driver <span class="text-danger">*</span></label>
                                            <select name="driver" id="driver" class="form-control selectize" required>
                                                <option value="">Select Driver:</option>
                                                @foreach($drivers as $d)
                                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Helper -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Helper <span class="text-danger">*</span></label>
                                            <select name="helper" id="helper" class="form-control selectize" required>
                                                <option value="">Select Helper:</option>
                                                @foreach($helpers as $h)
                                                    <option value="{{ $h->id }}">{{ $h->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Vehicle Type -->
                                    <div class="col-sm-3 mb-3">
                                        <div class="form-group-sm">
                                            <label>Vehicle Type <span class="text-danger">*</span></label>
                                            <select name="vehicle_type" id="vehicle_type" required class="form-control selectize">
                                                <option value="">Select Vehicle Type:</option>
                                                <option value="Car">Car</option>
                                                <option value="Van">Van</option>
                                                <option value="Bus">Bus</option>
                                                <option value="Lorry">Lorry</option>
                                                <option value="Bike">Bike</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Bill no -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label for="bill">Bill No <span class="text-danger">*</span></label>
                                            <input type="number" id="bill" name="bill" class="form-control" value="{{ old('bill') }}" min="0" style="height:30px;">
                                        </div>
                                    </div>

                                    <!-- Supplier -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label for="supplier">Supplier <span class="text-danger">*</span></label>
                                            <input type="text" id="supplier" name="supplier" class="form-control" value="{{ old('supplier') }}" style="height:30px;">
                                        </div>
                                    </div>

                                    <!-- Goods in no -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label for="goods">Goods In No <span class="text-danger">*</span></label>
                                            <input type="number" id="goods" name="goods" class="form-control" value="{{ old('goods') }}" min="0" style="height:30px;">
                                        </div>
                                    </div>

                                    <!-- To Member -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label for="member">To Member <span class="text-danger">*</span></label>
                                            <input type="text" id="member" name="member" class="form-control" value="{{ old('member') }}" style="height:30px;">
                                        </div>
                                    </div>

                                    <input type="hidden" id="rowCount1" name="rowCount1" class="form-control">

                                    <!-- Items Table (hidden by default for certain types) -->
                                    <div id="items_table_section" style="display:none;" class="card shadow-sm border-0 mt-4">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="my_data_table_3inv" name="my_data_table_3invoice" class="table table-responsive" style="margin-bottom: 10px; width: 100%;">
                                                    <thead style="background-color: white;" class="form-group-sm">
                                                        <tr>
                                                            <th>Items</th>
                                                            <th>Quantity</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr id="row_0" class="data-row">
                                                            <td>
                                                                <input type="text" class="form-control" name="item_se0" 
                                                                    id="item_se0" style="width:100%;height:30px;text-align:center;"
                                                                    oninput="checkAndAddRow(0)">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" name="qty_se0" 
                                                                    id="qty_se0" style="width:100%;height:30px;text-align:center;" 
                                                                    min="0" step="1" oninput="checkAndAddRow(0)">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="amount_se0" 
                                                                    id="amount_se0" style="text-align:center;height:30px;"
                                                                    oninput="checkAndAddRow(0)">
                                                            </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-danger btn-sm delete-btn" type="button" 
                                                                    onclick="deleteTableRow(0)">
                                                                    Delete
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Comment Section -->
                                    <div id="comment_section" class="card shadow-sm border-0 mt-4">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="comment"><strong>Comments</strong></label>
                                                <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Enter your comments here...">{{ old('comment') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Page Buttons -->
                                    <div class="mt-3 d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="{{ route('inward.inward_view_All') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
// Global row counter - starts at 1
var globalRowIndex = 1;

// Vehicle type function (same as Outward)
function getvehicle_type() {
    var vehicle_no = $('#vehicle_no').val();

    if (!vehicle_no || vehicle_no.trim() === '') {
        alert('Please select a vehicle number');
        return;
    }

    $.ajax({
        url: "{{ route('vehicledata') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            vehicle_no: vehicle_no
        },
        beforeSend: function() {
            $('#loading').show();
        },
        success: function(response) {
            console.log(response);
            if (response.status === 'success' && response.vehicle) {
                $('#vehicle_type').val(response.vehicle.vehicle_type).trigger('change');
                
                // Handle Select2 if present
                if ($('#vehicle_type').hasClass('select2-hidden-accessible')) {
                    $('#vehicle_type').select2('destroy').val(response.vehicle.vehicle_type).select2();
                }
            } else {
                alert("Vehicle not found.");
                clearVehicleFields();
            }
        },
        error: function(xhr) {
            var errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                xhr.responseJSON.message :
                'An error occurred while processing your request.';
            alert('Error: ' + errorMessage);
            clearVehicleFields();
        },
        complete: function() {
            $('#loading').hide();
        }
    });
}

function clearVehicleFields() {
    $('#vehicle_type').val('');
}

// Check if current row has data and if it's the last row, add a new row
function checkAndAddRow(currentIndex) {
    var $currentRow = $('#row_' + currentIndex);
    var $tbody = $('#my_data_table_3inv tbody');
    var $allRows = $tbody.find('tr.data-row');
    var lastRowIndex = $allRows.length - 1;
    
    // Check if this is the last row
    if (currentIndex === lastRowIndex) {
        // Check if current row has any data
        var item = $('#item_se' + currentIndex).val();
        var qty = $('#qty_se' + currentIndex).val();
        var amount = $('#amount_se' + currentIndex).val();
        
        // If any field has data, add a new row
        if (item || qty || amount) {
            addTableRow();
        }
    }
    
    updateRowCount();
    updateDeleteButtons();
}

// Add new row to table
function addTableRow() {
    var newRowIndex = globalRowIndex++;
    
    var newRow = `
        <tr id="row_${newRowIndex}" class="data-row">
            <td>
                <input type="text" name="item_se${newRowIndex}" class="form-control" id="item_se${newRowIndex}" 
                       style="width:100%;height:30px;text-align:center;"
                       oninput="checkAndAddRow(${newRowIndex})">
            </td>
            <td>
                <input type="number" class="form-control" name="qty_se${newRowIndex}" 
                       id="qty_se${newRowIndex}" style="width:100%;height:30px;text-align:center;" 
                       min="0" step="1" oninput="checkAndAddRow(${newRowIndex})">
            </td>
            <td>
                <input type="text" class="form-control" name="amount_se${newRowIndex}" 
                       id="amount_se${newRowIndex}" style="text-align:center;height:30px;"
                       oninput="checkAndAddRow(${newRowIndex})">
            </td>
            <td class="text-center">
                <button class="btn btn-danger btn-sm delete-btn" type="button" 
                        onclick="deleteTableRow(${newRowIndex})">
                    Delete
                </button>
            </td>
        </tr>
    `;
    
    $('#my_data_table_3inv tbody').append(newRow);
    updateRowCount();
    updateDeleteButtons();
}

// Delete table row
function deleteTableRow(rowIndex) {
    var $tbody = $('#my_data_table_3inv tbody');
    var rowCount = $tbody.find('tr.data-row').length;
    
    // Don't delete if it's the only row
    if (rowCount <= 1) {
        alert('Cannot delete the last row!');
        return;
    }
    
    $('#row_' + rowIndex).remove();
    updateRowCount();
    updateDeleteButtons();
}

// Update delete button visibility
function updateDeleteButtons() {
    var $tbody = $('#my_data_table_3inv tbody');
    var $rows = $tbody.find('tr.data-row');
    var rowCount = $rows.length;
    
    // Show delete buttons for all rows except when only 1 row exists
    if (rowCount === 1) {
        $('.delete-btn').prop('disabled', true).text('Required');
    } else {
        $('.delete-btn').prop('disabled', false).text('Delete');
    }
}

// Update row count
function updateRowCount() {
    var rowCount = $('#my_data_table_3inv tbody tr.data-row').length;
    $('#rowCount1').val(rowCount);
    console.log('Row count updated:', rowCount);
}

// Type toggle functionality
$(document).ready(function() {
    console.log('Document ready - initializing type toggle');

    var $typeSelect = $('#type');
    var $commentSection = $('#comment_section');
    var $itemsTable = $('#items_table_section');

    function toggleSections(value) {
        console.log('Toggle called with value:', value);
        if (value === "Supplier" || value === "Raw Material") {
            // Show items table and comments for both types
            $commentSection.show();
            $itemsTable.show();
            updateRowCount();
            updateDeleteButtons();
        } else {
            // Hide items table, show comments
            $commentSection.show();
            $itemsTable.hide();
            $('#rowCount1').val('0');
        }
    }

    // Initialize Select2 and attach change event
    if ($typeSelect.length) {
        if (!$typeSelect.hasClass('select2-hidden-accessible')) {
            $typeSelect.select2({
                tags: true
            });
        }

        $typeSelect.on('change', function() {
            var selectedValue = $(this).val();
            console.log('Type changed to:', selectedValue);
            toggleSections(selectedValue);
        });

        // Initial state
        toggleSections($typeSelect.val());
    }

    // Initial setup
    updateRowCount();
    updateDeleteButtons();

    // Form submission validation
    $('form').on('submit', function(e) {
        var typeValue = $('#type').val();
        if (typeValue === 'Supplier' || typeValue === 'Raw Material') {
            updateRowCount();
            var count = $('#rowCount1').val();
            console.log('Form submitting with row count:', count);

            var hasData = false;
            var $rows = $('#my_data_table_3inv tbody tr.data-row');

            $rows.each(function() {
                var rowId = $(this).attr('id').replace('row_', '');
                var item = $('[name="item_se' + rowId + '"]').val();
                var qty = $('[name="qty_se' + rowId + '"]').val();
                var amount = $('[name="amount_se' + rowId + '"]').val();

                if (item || qty || amount) {
                    hasData = true;
                    return false; // break
                }
            });

            if (!hasData) {
                alert('Please add at least one item for the selected type!');
                e.preventDefault();
                return false;
            }
        }
    });
});
</script>
@endpush
