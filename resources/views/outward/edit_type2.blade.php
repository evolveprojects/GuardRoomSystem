@extends('layouts.app')

@section('title', 'Edit Outward')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Outward - {{ $outward->outward_no }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('outward.all') }}">Outward Module</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                                <a href="{{ route('outward.all') }}">
                                    <button class="btn btn-primary" type="button">
                                        <i class="bi bi-chevron-left"></i> All Outwards
                                    </button>
                                </a>
                            </div>

                            <form action="{{ route('outward.type2.update') }}" method="POST">
                                @csrf
                          

                                <input type="hidden" name="id" value="{{ $outward->id }}">
                                <input type="hidden" id="rowCount1" name="rowCount1" class="form-control">

                                <div class="row">

                                    <!-- Outward No -->
                                    <div class="col-sm-3 mb-3">
                                        <div class="form-group-sm">
                                            <label>Outward NO <span class="text-danger">*</span></label>
                                            <input type="text" name="outward_no" value="{{ $outward->outward_no }}" class="form-control" readonly style="height:30px;">
                                        </div>
                                    </div>

                                    <!-- Center -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Center <span class="text-danger">*</span></label>
                                            <select name="center_id" id="center" class="form-control selectize" required>
                                                <option value="">Select Center:</option>
                                                @foreach($centers as $c)
                                                    <option value="{{ $c->id }}" {{ old('center_id', $outward->center_id) == $c->id ? 'selected' : '' }}>
                                                        {{ $c->center_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Type -->
                                    <div class="col-sm-3 mb-3">
                                        <div class="form-group-sm">
                                            <label for="type">Type <span style="color:red;">*</span></label>
                                            <select id="type" name="type" class="form-control selectize" style="height:30px;" required>
                                                <option value="">Select Type</option>
                                                <option value="Passenger" {{ old('type', $outward->type) == 'Passenger' ? 'selected' : '' }}>Passenger</option>
                                                <option value="Company" {{ old('type', $outward->type) == 'Company' ? 'selected' : '' }}>Company</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Vehicle No -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Vehicle No&nbsp;<span style="color:red;">*</span></label>
                                            <select name="vehicle_id" id="vehicle_no" required onchange="getvehicle_type()" class="form-control selectize">
                                                <option value="">Select Vehicle No:</option>
                                                @foreach ($vehicles as $v)
                                                    <option value="{{ $v->id }}" {{ old('vehicle_id', $outward->vehicle_id) == $v->id ? 'selected' : '' }}>
                                                        {{ $v->vehicle_no }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Date -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Date <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="date" name="date" id="date" value="{{ old('date', $outward->date) }}" class="form-control date-picker" style="height:30px;" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Driver -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Driver <span class="text-danger">*</span></label>
                                            <select name="driver_id" id="driver" class="form-control selectize" required>
                                                <option value="">Select Driver:</option>
                                                @foreach ($drivers as $d)
                                                    <option value="{{ $d->id }}" {{ old('driver_id', $outward->driver_id) == $d->id ? 'selected' : '' }}>
                                                        {{ $d->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Helper -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Helper <span class="text-danger">*</span></label>
                                            <select name="helper_id" id="helper" class="form-control selectize" required>
                                                <option value="">Select Helper:</option>
                                                @foreach ($helpers as $h)
                                                    <option value="{{ $h->id }}" {{ old('helper_id', $outward->helper_id) == $h->id ? 'selected' : '' }}>
                                                        {{ $h->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Vehicle Type -->
                                    <div class="col-sm-3 mb-3">
                                        <div class="form-group-sm">
                                            <label>Vehicle Type&nbsp;<span style="color:red;">*</span></label>
                                            <select name="vehicle_type" id="vehicle_type" required class="form-control selectize">
                                                <option value="">Select Vehicle Type:</option>
                                                <option value="Car" {{ old('vehicle_type', $outward->vehicle_type) == 'Car' ? 'selected' : '' }}>Car</option>
                                                <option value="Van" {{ old('vehicle_type', $outward->vehicle_type) == 'Van' ? 'selected' : '' }}>Van</option>
                                                <option value="Bus" {{ old('vehicle_type', $outward->vehicle_type) == 'Bus' ? 'selected' : '' }}>Bus</option>
                                                <option value="Lorry" {{ old('vehicle_type', $outward->vehicle_type) == 'Lorry' ? 'selected' : '' }}>Lorry</option>
                                                <option value="Bike" {{ old('vehicle_type', $outward->vehicle_type) == 'Bike' ? 'selected' : '' }}>Bike</option>
                                            </select>
                                        </div>
                                    </div>
                        

                                    <!-- Time Out -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label for="time_out">Time Out&nbsp;<span style="color:red;">*</span></label>
                                            <!-- In your Blade template -->
                                            <input type="time" id="time_out" name="time_out" class="form-control" 
                                                value="{{ old('time_out', $outward->time_out ? \Carbon\Carbon::parse($outward->time_out)->format('H:i') : '') }}" 
                                                style="height:30px;" required>
                                        </div>
                                    </div>

                                    <!-- Meter R/out -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label for="meter_out">Meter R/Out&nbsp;<span style="color:red;">*</span></label>
                                            <input type="number" id="meter_out" name="meter_out" class="form-control" value="{{ old('meter_out', $outward->meter_out) }}" min="0" style="height:30px;" required>
                                        </div>
                                    </div>

                                    <!-- Time In -->
<div class="col-sm-3">
    <div class="form-group-sm">
        <label for="time_in">Time In</label>
        <!-- Fix: Format the time_in value like time_out -->
        <input type="time" id="time_in" name="time_in" class="form-control" 
               value="{{ old('time_in', $outward->time_in ? \Carbon\Carbon::parse($outward->time_in)->format('H:i') : '') }}" 
               style="height:30px;">
    </div>
</div>

<!-- Meter R/In -->
<div class="col-sm-3">
    <div class="form-group-sm">
        <label for="meter_in">Meter R/In</label>
        <!-- Ensure value is properly set -->
        <input type="number" id="meter_in" name="meter_in" class="form-control" 
               value="{{ old('meter_in', $outward->meter_in) }}" 
               min="0" style="height:30px;">
    </div>
</div>

                                    

                            

                                <!-- Company table (hidden by default) -->
                                <div id="company_table_section" style="{{ old('type', $outward->type) == 'Company' ? '' : 'display:none;' }}" class="card shadow-sm border-0 mt-4">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="my_data_table_3inv" name="my_data_table_3invoice" class="table table-responsive" style="margin-bottom: 10px; width: 100%;">
                                                <thead style="background-color: white;" class="form-group-sm">
                                                    <tr>
                                                        <th>Center</th>
                                                        <th>Items</th>
                                                        <th>Quantity</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($outward->t2Items as $index => $item)
                                                    <tr id="row_{{ $index }}" class="data-row">
                                                        <td>
                                                            <input type="text" name="center_td{{ $index }}" class="form-control" id="center_td{{ $index }}" 
                                                                value="{{ $item->center ?? $item->no }}"
                                                                style="width:100%;height:30px;text-align:center;"
                                                                oninput="checkAndAddRow({{ $index }})">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="item_se{{ $index }}" 
                                                                id="item_se{{ $index }}" value="{{ $item->item }}"
                                                                style="width:100%;height:30px;text-align:center;"
                                                                oninput="checkAndAddRow({{ $index }})">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" name="qty_se{{ $index }}" 
                                                                id="qty_se{{ $index }}" value="{{ $item->quantity }}"
                                                                style="width:100%;height:30px;text-align:center;" 
                                                                min="0" step="1" oninput="checkAndAddRow({{ $index }})">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="amount_se{{ $index }}" 
                                                                id="amount_se{{ $index }}" value="{{ $item->amount }}"
                                                                style="text-align:center;height:30px;"
                                                                oninput="checkAndAddRow({{ $index }})">
                                                        </td>
                                                        <td class="text-blue text-center">
                                                            <button class="btn btn-danger btn-sm delete-btn" type="button" 
                                                                    onclick="deleteTableRow({{ $index }})">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr id="row_0" class="data-row">
                                                        <td>
                                                            <input type="text" name="center_td0" class="form-control" id="center_td0" 
                                                                style="width:100%;height:30px;text-align:center;"
                                                                oninput="checkAndAddRow(0)">
                                                        </td>
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
                                                        <td class="text-blue text-center">
                                                            <button class="btn btn-danger btn-sm delete-btn" type="button" 
                                                                    onclick="deleteTableRow(0)">
                                                                Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforelse
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
                                            <textarea name="comments" id="comment" rows="4" class="form-control" placeholder="Enter your comments here...">{{ old('comments', $outward->comments) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                               <!-- Inward Items Section -->
<div class="card shadow-sm border-0 mt-4">
    <div class="card-body">
        <div class="form-group">
            <label><strong>Inward Items</strong></label>
            <div class="border rounded p-3 bg-light">
                @php
                    // FIX: Change $item1 to $outward
                    $selectedItems = explode(',', $outward->inward_items ?? '');
                @endphp
                @foreach($otherpayments as $payment)
                    @if($payment->id >= 5 && $payment->id <= 9)
                        <div class="form-check mb-2">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="inward_items[]" 
                                   value="{{ $payment->id }}" 
                                   id="inward_item_{{ $payment->id }}"
                                   {{ in_array($payment->id, $selectedItems) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inward_item_{{ $payment->id }}">
                                {{ $payment->payment_type }}
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

                                <!-- Page Buttons -->
                                <div class="mt-3 d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('outward.all') }}" class="btn btn-secondary">Cancel</a>
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

        // Initialize Select2 on page load
        $(document).ready(function() {
            // Initialize other selectize dropdowns (NOT inward_items anymore)
            $(".selectize").select2();
        });


// Global row counter - start from the number of existing rows
var globalRowIndex = {{ $outward->t2Items->count() > 0 ? $outward->t2Items->count() : 1 }};

// Vehicle type function
function getvehicle_type() {
    var vehicle_no = $('#vehicle_no').val();

    if (!vehicle_no || vehicle_no.trim() === '') {
        alert('Please enter a vehicle number');
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
                // Update the select element
                $('#vehicle_type').val(response.vehicle.vehicle_type).trigger('change');
                
                // If using Select2, you might need this:
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
        var center = $('#center_td' + currentIndex).val();
        var item = $('#item_se' + currentIndex).val();
        var qty = $('#qty_se' + currentIndex).val();
        var amount = $('#amount_se' + currentIndex).val();
        
        // If any field has data, add a new row
        if (center || item || qty || amount) {
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
                <input type="text" name="center_td${newRowIndex}" class="form-control" id="center_td${newRowIndex}" 
                       style="width:100%;height:30px;text-align:center;"
                       oninput="checkAndAddRow(${newRowIndex})">
            </td>
            <td>
                <input type="text" class="form-control" name="item_se${newRowIndex}" 
                       id="item_se${newRowIndex}" style="width:100%;height:30px;text-align:center;"
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
            <td class="text-blue text-center">
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
    
    // Always show delete buttons for all rows
    $('.delete-btn').show();
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
    var $companyTable = $('#company_table_section');

    function toggleSections(value) {
        console.log('Toggle called with value:', value);
        if (value === "Company") {
            // SHOW both comments and company table for Company
            $commentSection.show();
            $companyTable.show();
            updateRowCount();
            updateDeleteButtons();
        } else {
            // For Passenger, show comments, hide company table
            $commentSection.show();
            $companyTable.hide();
            $('#rowCount1').val('0');
        }
    }

    // Initialize Select2 (if you use it) and attach change event
    if ($typeSelect.length) {
        if (!$typeSelect.hasClass('select2-hidden-accessible')) {
            $typeSelect.select2({
                tags: true
            });
        }

        // On change (works for both native select and select2)
        $typeSelect.on('change', function() {
            var selectedValue = $(this).val();
            console.log('Type changed to:', selectedValue);
            toggleSections(selectedValue);
        });

        // Initial state: set based on current value
        toggleSections($typeSelect.val());
    } else {
        // fallback: show comments, hide company table
        $commentSection.show();
        $companyTable.hide();
    }

    // Initial setup
    updateRowCount();
    updateDeleteButtons();

    // Before form submission, update row count
    $('form').on('submit', function(e) {
        if ($('#type').val() === 'Company') {
            updateRowCount();
            var count = $('#rowCount1').val();
            console.log('Form submitting with row count:', count);

            var hasData = false;
            var $rows = $('#my_data_table_3inv tbody tr.data-row');

            $rows.each(function() {
                var rowId = $(this).attr('id').replace('row_', '');
                var center = $('[name="center_td' + rowId + '"]').val();
                var item = $('[name="item_se' + rowId + '"]').val();
                var qty = $('[name="qty_se' + rowId + '"]').val();
                var amount = $('[name="amount_se' + rowId + '"]').val();

                if (center || item || qty || amount) {
                    hasData = true;
                    return false; // break
                }
            });

            if (!hasData) {
                alert('Please add at least one item for Company type!');
                e.preventDefault();
                return false;
            }
        }
    });
});
</script>
@endpush