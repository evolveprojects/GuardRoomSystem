@extends('layouts.app')

@section('title', 'Outward Type 1')

@section('content')
    <main class="app-main">

        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Outward Module Type 1</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Outward Module</li>
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
                            <form action="{{ route('outward.saveoutward_type_1') }}" method="POST">
                                @csrf
                                <div class="card-body">

                                    <div class="col-md-6 d-flex align-items-center">
                                        <a href="{{ route('outward.outward_view_All') }}"><button class="btn btn-primary"
                                                type="button">
                                                <i class="bi bi-chevron-left"></i></i> All Outwards
                                            </button></a>
                                    </div>
                                    <br>

                                    <div class="row">

                                        <!-- Outward No -->
                                        <div class="col-sm-3 mb-3">
                                            <div class="form-group-sm">
                                                <label for="phone">Outward NO&nbsp;<span
                                                        style="color:red;">*</span></label>
                                                <input type="text" class="form-control" name="outward_number"
                                                    style="width:100%;height:30px;text-align: left;"
                                                    value="{{ $outno }}" readonly>
                                            </div>
                                        </div>

                                        <!-- Center -->
                                        <div class="col-sm-3 mb-3">
                                            <div class="form-group-sm">
                                                <label for="center">Center&nbsp;<span style="color:red;">*</span></label>
                                                <select name="center" id="center" required
                                                    class="form-control selectize">
                                                    <option value="">Select Center:</option>
                                                    @foreach ($centers as $c)
                                                        <option value="{{ $c->id }}">{{ $c->center_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Vehicle No -->
                                        <div class="col-sm-3 mb-3">
                                            <div class="form-group-sm">
                                                <label>Vehicle No&nbsp;<span style="color:red;">*</span></label>
                                                <select name="vehicle_no" id="vehicle_no" required
                                                    onchange="getvehicle_type()" class="form-control selectize">
                                                    <option value="">Select Vehicle No:</option>
                                                    @foreach ($vehicles as $v)
                                                        <option value="{{ $v->id }}">{{ $v->vehicle_no }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Date -->
                                        <div class="col-sm-3 form-group-sm mb-3">
                                            <label for="_Expectdate">Date&nbsp;<span style="color:red;">*</span></label>
                                            <div class="input-group">
                                                <input type="date" class="form-control date-picker"
                                                    value="<?php echo date('Y-m-d'); ?>" data-date-format="yyyy-mm-dd" name="date"
                                                    id="date" style="width:100%;height:30px;text-align: left;">
                                            </div>
                                        </div>

                                        <!-- Driver -->
                                        <div class="col-sm-3 mb-3">
                                            <div class="form-group-sm">
                                                <label>Driver <span class="text-danger">*</span></label>
                                                <select name="driver" id="driver" class="form-control selectize"
                                                    required>
                                                    <option value="">Select Driver:</option>
                                                    @foreach ($drivers as $d)
                                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Helper -->
                                        <div class="col-sm-3 mb-3">
                                            <div class="form-group">
                                                <label for="helper">Helper&nbsp;<span style="color:red;">*</span></label>
                                                <select name="helper" id="helper" required
                                                    class="form-control selectize">
                                                    <option value="">Select Helper:</option>
                                                    @foreach ($helpers as $h)
                                                        <option value="{{ $h->id }}">{{ $h->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="rowCount1" id="rowCount1" class="form-control">

                                        <!-- Vehicle Type -->
                                        <div class="col-sm-3 mb-3">
                                            <div class="form-group-sm">
                                                <label>Vehicle Type&nbsp;<span style="color:red;">*</span></label>
                                                <select name="vehicle_type" id="vehicle_type" required
                                                    class="form-control selectize">
                                                    <option value="">Select Vehicle Type:</option>
                                                    <option value="Car">Car</option>
                                                    <option value="Van">Van</option>
                                                    <option value="Bus">Bus</option>
                                                    <option value="Lorry">Lorry</option>
                                                    <option value="Bike">Bike</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Weight Field - Added after Vehicle Type -->
                                        <div class="col-sm-3 mb-3">
                                    <div class="form-group-sm">
                                        <label>Weight (mt)&nbsp;<span style="color:red;">*</span></label>
                                        <input type="number"
                                            class="form-control"
                                            name="weight"
                                            id="weight"
                                            style="width:100%;height:30px;background-color:#e9ecef;"
                                            readonly>
                                    </div>
                                </div>



                                        <!-- Time In / Time Out / Meter R/In / Meter R/Out -->

                                        <div class="col-sm-3">
                                            <div class="form-group-sm">
                                                <label for="time_out">Time Out&nbsp;<span
                                                        style="color:red;">*</span></label>
                                                <input type="time" id="time_out" name="time_out"
                                                    class="form-control" style="width:100%;height:30px;text-align: left;">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group-sm">
                                                <label for="meter_out">Meter R/Out&nbsp;<span
                                                        style="color:red;">*</span></label>
                                                <input type="number" id="meter_out" name="meter_out"
                                                    class="form-control" min="0"
                                                    style="width:100%;height:30px;text-align: left;">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                        </div>

                                    </div>
                                    <br>

                                    <!-- Outward Table -->
                                    <div class="table-responsive">
                                        <table id="my_data_table_3inv" name="my_data_table_3invoice"
                                            class="table table-responsive" style="margin-bottom: 10px; width: 100%;">

                                            <thead style="background-color: white;" class="form-group-sm">
                                                <tr>
                                                    <!-- <th style="width: 200px !important;">Item Code</th> -->
                                                    <th style="">AOD No</th>
                                                    <!-- <th style="width: 90px !important;">GSM</th> -->
                                                    <th style="">Items</th>
                                                    <th style="">Customer</th>
                                                    <th style="">Quantity</th>
                                                    <th style="">Amount</th>
                                                    <th style="">Action</th>


                                                </tr>
                                            </thead>


                                            <tbody>
                                                @for ($i = 0; $i < 2; $i++)
                                                    <tr id="row_{{ $i }}">

                                                        <td id="aod_t{{ $i }}">
                                                            <select name="aod_td{{ $i }}"
                                                                class="form-control selectize"
                                                                id="aod_td{{ $i }}"
                                                                style="width:100%;height:30px;"
                                                                onchange="getDataTblOtherDetails('{{ $i }}');">
                                                                <option value="">Select AOD</option>
                                                                @if (isset($AOD_no['value']) && is_array($AOD_no['value']))
                                                                    @foreach ($AOD_no['value'] as $aod)
                                                                        <option value="{{ $aod['SequenceNumber'] }}">
                                                                            {{ $aod['ShipmentNumber'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>
                                                        <td id="item_td{{ $i }}">

                                                            {{-- <input type="text" class="form-control"
                                                                name="item_se{{ $i }}"
                                                                id="item_se{{ $i }}"
                                                                style="width:100%;height:30px;text-align: left;"> --}}

                                                            <select name="item_se{{ $i }}"
                                                                class="form-control selectize"
                                                                id="item_se{{ $i }}"
                                                                style="width:100%;height:30px;"
                                                                onchange="getDataTblOtherDetails('{{ $i }}');">
                                                                <option value="">Select Items</option>
                                                                @if (isset($items['value']) && is_array($items['value']))
                                                                    @foreach ($items['value'] as $item)
                                                                        <option value="{{ $item['ItemNumber'] }}">
                                                                            {{ $item['Description'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>
                                                        <td id="customer_td{{ $i }}">



                                                            <select name="customer_se{{ $i }}"
                                                                class="form-control selectize"
                                                                id="customer_se{{ $i }}"
                                                                style="width:100%;height:30px;"
                                                                onchange="getDataTblOtherDetails('{{ $i }}');">
                                                                <option value="">Select Customer</option>
                                                                @if (isset($customers['value']) && is_array($customers['value']))
                                                                    @foreach ($customers['value'] as $cus)
                                                                        <option value="{{ $cus['CustomerNumber'] }}">
                                                                            {{ $cus['CustomerName'] }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </td>

                                                        <td id="qty_td{{ $i }}">
                                                            <input type="number"
                                                                    class="form-control"
                                                                    name="qty_se{{ $i }}"
                                                                    id="qty_se{{ $i }}"
                                                                    style="width:100%;height:30px;text-align:left;"
                                                                    min="0"
                                                                    step="1"
                                                                    oninput="calculateWeight()">
                                                        </td>

                                                        <td id="amount_td{{ $i }}">
                                                            <input type="text" class="form-control"
                                                                name="amount_se{{ $i }}"
                                                                id="amount_se{{ $i }}"
                                                                style="width:100%;height:30px;text-align:left;"
                                                                onblur="formatAmount(this)">
                                                        </td>
                                                        <td class="text-blue ">
                                                            <button class="btn btn-danger btn-sm" type="button"
                                                                onclick="deleteTableRow('{{ $i }}')">Delete
                                                                <i class="fa fa-trash fa-lg"></i>
                                                            </button>
                                                        </td>

                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Comment Section -->
                                    <div class="card shadow-sm border-0 mt-4">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="comment"><strong>Comments</strong></label>
                                                <textarea class="form-control" id="comment" name="comment" rows="4"
                                                    placeholder="Enter your comments here..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Page-level Buttons -->
                                    <div class="mt-3 d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-primary" value="save"
                                            name="save">Save</button>
                                        <button type="submit" class="btn btn-success" value="save_close"
                                            name="save_close">Save & Close</button>
                                        <button type="button" class="btn btn-secondary"
                                            onclick="window.close();">Close</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        let rowCount = 2; // Existing rows count

const MAX_QTY = 10; // Max quantity for dropdown

// Populate quantity dropdown
function populateQtyDropdown(index) {
    const select = document.getElementById(`qty_se${index}`);
    if (!select) return;
    select.innerHTML = '<option value="">Select Qty</option>';
    for (let i = 1; i <= MAX_QTY; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.text = i;
        select.appendChild(option);
    }
}

// Initialize existing rows
for (let i = 0; i < rowCount; i++) {
    populateQtyDropdown(i);
}

// Function called when AOD changes
function getDataTblOtherDetails(index) {
    const aodSelect = document.getElementById(`aod_td${index}`);
    const aodValue = aodSelect.value;

    // Show delete button
    const actionCell = document.getElementById(`row_${index}`).querySelector('td:last-child');
    if (aodValue && actionCell.innerHTML.trim() === '') {
        actionCell.innerHTML = `
            <button class="btn btn-danger btn-sm" type="button" onclick="deleteTableRow(${index})">
                Delete
            </button>
        `;
    }

    // Check last row; if it has value, add new row
    const lastRow = document.querySelector('#my_data_table_3inv tbody tr:last-child');
    const lastRowAOD = lastRow.querySelector('select');
    if (lastRowAOD.value !== '') {
        addRow();
    }
    countRows();
    getother_details(index);
    calculateWeight();
}

function getother_details(index) {
    var cmbSelectVal = document.getElementById('aod_td' + index).value;

    $.ajax({
        url: "{{ route('sage300_aoddata') }}",
        type: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            cmbSelectVal: cmbSelectVal,
        },
        success: function(data) {
            console.log(data);
            // Update fields with the retrieved data
            // document.getElementById('amount_txt' + no).value = data.slab.sell_price;

            // Refresh Select2 dropdowns
            $(".selectize").select2();
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: ", status, error);
        }
    });
}

// Add new row dynamically - FIXED VERSION
function addRow() {
    const tableBody = document.querySelector('#my_data_table_3inv tbody');
    const index = rowCount;

    const row = document.createElement('tr');
    row.id = `row_${index}`;
    row.innerHTML = `
        <td id="aod_t${index}">
            <select name="aod_td${index}" class="form-control selectize" id="aod_td${index}" style="width:100%;height:35px;" onchange="getDataTblOtherDetails(${index});">
                <option value="">Select AOD</option>
                @if (isset($AOD_no['value']) && is_array($AOD_no['value']))
                    @foreach ($AOD_no['value'] as $aod)
                        <option value="{{ $aod['SequenceNumber'] }}">
                            {{ $aod['ShipmentNumber'] }}
                        </option>
                    @endforeach
                @endif
            </select>
        </td>
        <td id="item_td${index}">
            <select name="item_se${index}" class="form-control selectize" id="item_se${index}" style="width:100%;height:30px;" onchange="getDataTblOtherDetails(${index});">
                <option value="">Select Items</option>
                @if (isset($items['value']) && is_array($items['value']))
                    @foreach ($items['value'] as $item)
                        <option value="{{ $item['ItemNumber'] }}">
                            {{ $item['Description'] }}
                        </option>
                    @endforeach
                @endif
            </select>
        </td>
        <td id="customer_td${index}">
            <select name="customer_se${index}" class="form-control selectize" id="customer_se${index}" style="width:100%;height:30px;" onchange="getDataTblOtherDetails(${index});">
                <option value="">Select Customer</option>
                @if (isset($customers['value']) && is_array($customers['value']))
                    @foreach ($customers['value'] as $cus)
                        <option value="{{ $cus['CustomerNumber'] }}">
                            {{ $cus['CustomerName'] }}
                        </option>
                    @endforeach
                @endif
            </select>
        </td>
        <td id="qty_td${index}">
            <input type="number" oninput="calculateWeight()" class="form-control" name="qty_se${index}" id="qty_se${index}" style="width:100%;height:30px;text-align:left;" min="0" step="1">
        </td>
        <td id="amount_td${index}">
            <input type="text" class="form-control" name="amount_se${index}" id="amount_se${index}" style="width:100%;height:30px;text-align:left;" onblur="formatAmount(this)">
        </td>
        <td class="text-blue">
            <button class="btn btn-danger btn-sm" type="button" onclick="deleteTableRow(${index})">
                Delete
            </button>
        </td>
    `;
    
    tableBody.appendChild(row);

    // Initialize Select2 for the new row's dropdowns
    $(`#aod_td${index}`).select2();
    $(`#item_se${index}`).select2();
    $(`#customer_se${index}`).select2();

    rowCount++;
    countRows();
}

// Delete row - FIXED VERSION
function deleteTableRow(num) {
    // Clear all fields
    const aod = document.getElementById('aod_td' + num);
    const item = document.getElementById('item_se' + num);
    const customer = document.getElementById('customer_se' + num);
    const qty = document.getElementById('qty_se' + num);
    const amount = document.getElementById('amount_se' + num);

    if (aod) {
        aod.selectedIndex = 0;
        $(`#aod_td${num}`).val('').trigger('change');
    }
    if (item) {
        item.value = '';
        $(`#item_se${num}`).val('').trigger('change');
    }
    if (customer) {
        customer.value = '';
        $(`#customer_se${num}`).val('').trigger('change');
    }
    if (qty) {
        qty.value = '';
    }
    if (amount) {
        amount.value = '';
    }

    countRows();
    calculateWeight(); // Recalculate weight after deletion
}

function countRows() {
    var descElements = document.querySelectorAll('[id^="aod_td"]');
    var count = descElements.length;
    document.getElementById('rowCount1').value = count;
    console.log("Updated count of desc_td elements: " + count);
}

function getvehicle_type() {
    var vehicle_no = $('#vehicle_no').val();

    // Validate input before sending
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
                $('#vehicle_type').val(response.vehicle.vehicle_type).trigger('change');
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

// Helper function to clear fields
function clearVehicleFields() {
    $('#vehicle_id').val('');
    $('#vehicle_type').val('');
    $('#owner_name').val('');
    $('#capacity').val('');
}

function calculateWeight() {
    let totalQuantity = 0;
    const qtyInputs = document.querySelectorAll('[id^="qty_se"]');

    qtyInputs.forEach(input => {
        const value = parseFloat(input.value) || 0;
        totalQuantity += value;
    });

    const weight = totalQuantity / 1000;
    document.getElementById('weight').value = weight.toFixed(2);
}
    </script>


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

        .btn-delete-circle {
            background-color: #dc3545;
            /* red */
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-delete-circle:hover {
            background-color: #c82333;
        }
    </style>
