@extends('layouts.app')

@section('title', 'Edit Inward')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Inward - {{ $inward->inward_no }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('inward.inward_view_All') }}">All Inwards</a></li>
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
                                <a href="{{ route('inward.inward_view_All') }}">
                                    <button class="btn btn-primary">
                                        <i class="bi bi-chevron-left"></i> All Inwards
                                    </button>
                                </a>
                            </div>

                            <form action="{{ route('inward.update', $inward->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="id" value="{{ $inward->id }}">
                                <input type="hidden" id="rowCount1" name="rowCount1">

                                <div class="row">
                                    <!-- Inward No -->
                                    <div class="col-sm-3 mb-3">
                                        <div class="form-group-sm">
                                            <label>Inward NO <span class="text-danger">*</span></label>
                                            <input type="text" name="inward_no" value="{{ $inward->inward_no }}" class="form-control" readonly style="height:30px;">
                                        </div>
                                    </div>

                                    <!-- Center -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Center <span class="text-danger">*</span></label>
                                            <select name="center_id" id="center" class="form-control selectize" required>
                                                <option value="">Select Center:</option>
                                                @foreach($centers as $c)
                                                    <option value="{{ $c->id }}" {{ old('center_id', $inward->center_id) == $c->id ? 'selected' : '' }}>
                                                        {{ $c->center_name }}
                                                    </option>
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
                                                <option value="Supplier" {{ old('type', $inward->type) == 'Supplier' ? 'selected' : '' }}>Supplier</option>
                                                <option value="Raw Material" {{ old('type', $inward->type) == 'Raw Material' ? 'selected' : '' }}>Raw Material</option>
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
                                                    <option value="{{ $v->id }}" {{ old('vehicle_id', $inward->vehicle_id) == $v->id ? 'selected' : '' }}>
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
                                            <input type="date" name="date" id="date" 
                                                value="{{ old('date', $inward->date ? \Carbon\Carbon::parse($inward->date)->format('Y-m-d') : '') }}" 
                                                class="form-control" style="height:30px;" required>
                                        </div>
                                    </div>

                                    <!-- Driver -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Driver <span class="text-danger">*</span></label>
                                            <select name="driver_id" id="driver" class="form-control selectize" required>
                                                <option value="">Select Driver:</option>
                                                @foreach($drivers as $d)
                                                    <option value="{{ $d->id }}" {{ old('driver_id', $inward->driver_id) == $d->id ? 'selected' : '' }}>
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
                                                @foreach($helpers as $h)
                                                    <option value="{{ $h->id }}" {{ old('helper_id', $inward->helper_id) == $h->id ? 'selected' : '' }}>
                                                        {{ $h->name }}
                                                    </option>
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
                                                <option value="Car" {{ old('vehicle_type', $inward->vehicle_type) == 'Car' ? 'selected' : '' }}>Car</option>
                                                <option value="Van" {{ old('vehicle_type', $inward->vehicle_type) == 'Van' ? 'selected' : '' }}>Van</option>
                                                <option value="Bus" {{ old('vehicle_type', $inward->vehicle_type) == 'Bus' ? 'selected' : '' }}>Bus</option>
                                                <option value="Lorry" {{ old('vehicle_type', $inward->vehicle_type) == 'Lorry' ? 'selected' : '' }}>Lorry</option>
                                                <option value="Bike" {{ old('vehicle_type', $inward->vehicle_type) == 'Bike' ? 'selected' : '' }}>Bike</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Bill no -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Bill No <span class="text-danger">*</span></label>
                                            <input type="number" id="bill_no" name="bill_no" class="form-control" 
                                                value="{{ old('bill_no', $inward->bill_no) }}" min="0" style="height:30px;" required>
                                        </div>
                                    </div>

                                    <!-- Supplier -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Supplier <span class="text-danger">*</span></label>
                                            <input type="text" id="supplier" name="supplier" class="form-control" 
                                                value="{{ old('supplier', $inward->supplier) }}" style="height:30px;" required>
                                        </div>
                                    </div>

                                    <!-- Goods in no -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>Goods In No <span class="text-danger">*</span></label>
                                            <input type="number" id="goods_in_no" name="goods_in_no" class="form-control" 
                                                value="{{ old('goods_in_no', $inward->goods_in_no) }}" min="0" style="height:30px;" required>
                                        </div>
                                    </div>

                                    <!-- To Member -->
                                    <div class="col-sm-3">
                                        <div class="form-group-sm">
                                            <label>To Member <span class="text-danger">*</span></label>
                                            <input type="text" id="to_member" name="to_member" class="form-control" 
                                                value="{{ old('to_member', $inward->to_member) }}" style="height:30px;" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Items Table -->
                                <div id="items_table_section" class="card shadow-sm border-0 mt-4">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="my_data_table_3inv" class="table table-responsive" style="margin-bottom: 10px; width: 100%;">
                                                <thead style="background-color: white;">
                                                    <tr>
                                                        <th>Items</th>
                                                        <th>Quantity</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($inward->items as $index => $item)
                                                        <tr id="row_{{ $index }}" class="data-row">
                                                            <td>
                                                                <input type="text" name="item_se{{ $index }}" class="form-control" id="item_se{{ $index }}" 
                                                                    value="{{ $item->item_name }}" style="width:100%;height:30px;text-align:center;"
                                                                    oninput="checkAndAddRow({{ $index }})">
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" name="qty_se{{ $index }}" id="qty_se{{ $index }}" 
                                                                    value="{{ $item->quantity }}" style="width:100%;height:30px;text-align:center;" 
                                                                    min="0" step="1" oninput="checkAndAddRow({{ $index }})">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="amount_se{{ $index }}" id="amount_se{{ $index }}" 
                                                                    value="{{ $item->amount }}" style="text-align:center;height:30px;" oninput="checkAndAddRow({{ $index }})">
                                                            </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-danger btn-sm delete-btn" type="button" 
                                                                    onclick="deleteTableRow({{ $index }})">
                                                                    Delete
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr id="row_0" class="data-row">
                                                            <td><input type="text" name="item_se0" class="form-control" id="item_se0" style="width:100%;height:30px;text-align:center;" oninput="checkAndAddRow(0)"></td>
                                                            <td><input type="number" class="form-control" name="qty_se0" id="qty_se0" style="width:100%;height:30px;text-align:center;" min="0" step="1" oninput="checkAndAddRow(0)"></td>
                                                            <td><input type="text" class="form-control" name="amount_se0" id="amount_se0" style="text-align:center;height:30px;" oninput="checkAndAddRow(0)"></td>
                                                            <td class="text-center">
                                                                <button class="btn btn-danger btn-sm delete-btn" type="button" onclick="deleteTableRow(0)">
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
                                <div class="card shadow-sm border-0 mt-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="comment"><strong>Comments</strong></label>
                                            <textarea name="comments" id="comment" rows="4" class="form-control" placeholder="Enter your comments here...">{{ old('comments', $inward->comments) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="mt-3 d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('inward.inward_view_All') }}" class="btn btn-secondary">Cancel</a>
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
var globalRowIndex = {{ $inward->items->count() > 0 ? $inward->items->count() : 1 }};

// 🔥 VEHICLE TYPE AUTO-LOAD + onchange (WORKS PERFECTLY)
function getvehicle_type() {
    var vehicle_no = $('#vehicle_no').val();
    if (!vehicle_no) {
        $('#vehicle_type').val('').trigger('change');
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
            console.log('Loading vehicle type for:', vehicle_no);
        },
        success: function(response) {
            console.log('Vehicle response:', response);
            if (response.status === 'success' && response.vehicle) {
                $('#vehicle_type').val(response.vehicle.vehicle_type).trigger('change');
                console.log('Vehicle type set to:', response.vehicle.vehicle_type);
            } else {
                $('#vehicle_type').val('').trigger('change');
                alert("Vehicle not found.");
            }
        },
        error: function(xhr) {
            console.error('Vehicle lookup error:', xhr);
            $('#vehicle_type').val('').trigger('change');
        }
    });
}

// Dynamic row functions (EXACTLY like Outward)
function checkAndAddRow(currentIndex) {
    var $tbody = $('#my_data_table_3inv tbody');
    var $allRows = $tbody.find('tr.data-row');
    var lastRowIndex = $allRows.length - 1;
    
    if (currentIndex === lastRowIndex) {
        var item = $('#item_se' + currentIndex).val();
        var qty = $('#qty_se' + currentIndex).val();
        var amount = $('#amount_se' + currentIndex).val();
        
        if (item || qty || amount) {
            addTableRow();
        }
    }
    
    updateRowCount();
    updateDeleteButtons();
}

function addTableRow() {
    var newRowIndex = globalRowIndex++;
    var newRow = `
        <tr id="row_${newRowIndex}" class="data-row">
            <td>
                <input type="text" name="item_se${newRowIndex}" class="form-control" id="item_se${newRowIndex}" 
                       style="width:100%;height:30px;text-align:center;" oninput="checkAndAddRow(${newRowIndex})">
            </td>
            <td>
                <input type="number" class="form-control" name="qty_se${newRowIndex}" id="qty_se${newRowIndex}" 
                       style="width:100%;height:30px;text-align:center;" min="0" step="1" oninput="checkAndAddRow(${newRowIndex})">
            </td>
            <td>
                <input type="text" class="form-control" name="amount_se${newRowIndex}" id="amount_se${newRowIndex}" 
                       style="text-align:center;height:30px;" oninput="checkAndAddRow(${newRowIndex})">
            </td>
            <td class="text-center">
                <button class="btn btn-danger btn-sm delete-btn" type="button" onclick="deleteTableRow(${newRowIndex})">
                    Delete
                </button>
            </td>
        </tr>
    `;
    
    $('#my_data_table_3inv tbody').append(newRow);
    updateRowCount();
    updateDeleteButtons();
}

function deleteTableRow(rowIndex) {
    var $tbody = $('#my_data_table_3inv tbody');
    var rowCount = $tbody.find('tr.data-row').length;
    
    if (rowCount <= 1) {
        alert('Cannot delete the last row!');
        return;
    }
    
    $('#row_' + rowIndex).remove();
    updateRowCount();
    updateDeleteButtons();
}

function updateDeleteButtons() {
    var rowCount = $('#my_data_table_3inv tbody tr.data-row').length;
    if (rowCount === 1) {
        $('.delete-btn').prop('disabled', true).text('Required');
    } else {
        $('.delete-btn').prop('disabled', false).text('Delete');
    }
}

function updateRowCount() {
    var rowCount = $('#my_data_table_3inv tbody tr.data-row').length;
    $('#rowCount1').val(rowCount);
    console.log('Row count:', rowCount);
}

// 🔥 COMPLETE INITIALIZATION (Auto-loads vehicle type!)
$(document).ready(function() {
    console.log('Edit Inward loaded');
    
    updateRowCount();
    updateDeleteButtons();
    
    // 🔥 AUTO-LOAD EXISTING VEHICLE TYPE ON PAGE LOAD
    var currentVehicleId = $('#vehicle_no').val();
    if (currentVehicleId) {
        console.log('🔥 Auto-loading vehicle type for existing vehicle ID:', currentVehicleId);
        setTimeout(function() {
            getvehicle_type();  // Triggers AJAX to populate vehicle_type
        }, 500);  // Small delay ensures Selectize is ready
    }
    
    // Form validation
    $('form').on('submit', function(e) {
        updateRowCount();
        var hasData = false;
        var $rows = $('#my_data_table_3inv tbody tr.data-row');
        
        $rows.each(function() {
            var rowId = $(this).attr('id').replace('row_', '');
            var item = $('[name="item_se' + rowId + '"]').val();
            var qty = $('[name="qty_se' + rowId + '"]').val();
            var amount = $('[name="amount_se' + rowId + '"]').val();
            
            if (item || qty || amount) {
                hasData = true;
                return false;
            }
        });
        
        if (!hasData) {
            alert('Please add at least one item!');
            e.preventDefault();
            return false;
        }
    });
});
</script>
@endpush
