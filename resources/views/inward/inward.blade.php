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

                            <div class="col-md-6 d-flex align-items-center">
                                <button class="btn btn-primary">
                                    <i class="bi bi-plus-lg"></i> All Outwards
                                </button>
                            </div>
                            <br>

                            <div class="row">

                                <!-- Inward No -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="phone">Outward NO&nbsp;<span style="color:red;">*</span></label>
                                        <input type="text" readonly class="form-control">
                                    </div>
                                </div>

                                <!-- Center -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="center">Center&nbsp;<span style="color:red;">*</span></label>
                                        <select name="center" id="center" required class="form-control selectize">
                                            <option value="">Select Center:</option>
                                            @foreach($centers as $c)
                                                <option value="{{ $c->id }}">{{ $c->center_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Type -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="type">Type<span style="color:red;">*</span></label>
                                        <input type="type" id="type" name="type" class="form-control">
                                    </div>
                                </div>

                                <!-- Date -->
                                <div class="col-sm-3 form-group-sm">
                                    <label for="_Expectdate">Date&nbsp;<span style="color:red;">*</span></label>
                                    <div class="input-group">
                                        <input type="date" class="form-control date-picker"
                                               value="<?php echo date('Y-m-d'); ?>"
                                               data-date-format="yyyy-mm-dd"
                                               name="date" id="date">
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
                                        <label for="helper">Helper&nbsp;<span style="color:red;">*</span></label>
                                        <select name="helper" id="helper" required class="form-control selectize">
                                            <option value="">Select Helper:</option>
                                            @foreach($helpers as $h)
                                                <option value="{{ $h->id }}">{{ $h->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Vehicle No -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label>Vehicle No&nbsp;<span style="color:red;">*</span></label>
                                        <select name="vehicle_no" id="vehicle_no" required class="form-control selectize">
                                            <option value="">Select Vehicle No:</option>
                                            @foreach($vehicles as $v)
                                                <option value="{{ $v->id }}">{{ $v->vehicle_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                 <!-- Vehicle Type -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label>Vehicle Type&nbsp;<span style="color:red;">*</span></label>
                                        <select name="vehicle_type" id="vehicle_type" required class="form-control selectize">
                                            <option value="">Select Vehicle Type:</option>
                                            @foreach($vehicles as $v)
                                                <option value="{{ $v->id }}">{{ $v->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Bill no -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="bill">Bill no:<span style="color:red;">*</span></label>
                                        <input type="number" id="bill" name="bill" class="form-control">
                                    </div>
                                </div>

                                <!-- Supplier-->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="supplier">Supplier:<span style="color:red;">*</span></label>
                                        <input type="name" id="supplier" name="supplier" class="form-control">
                                    </div>
                                </div>

                                <!-- Goods in no -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="goods">Goods in no:<span style="color:red;">*</span></label>
                                        <input type="number" id="goods" name="goods" class="form-control">
                                    </div>
                                </div>

                                <!-- To Member-->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="member">To Member:<span style="color:red;">*</span></label>
                                        <input type="name" id="member" name="member" class="form-control">
                                    </div>
                                </div>

                                <input type="hidden" name="rowCount1" id="rowCount1" class="form-control">
 
                            </div>
                            <br>

                            <!-- Outward Table -->
                                                   <div class="table-responsive">
                                                            <table id="my_data_table_3inv"
                                                                name="my_data_table_3invoice"
                                                                class="table table-responsive"
                                                                style="margin-bottom: 10px; width: 100%;">

                                            <thead style="background-color: white;" class="form-group-sm">
                                                <tr>
                                                    <!-- <th style="width: 200px !important;">Item Code</th> -->
                                                    <th style="">No</th>
                                                    <!-- <th style="width: 90px !important;">GSM</th> -->
                                                    <th style="">Items</th>
                                                    <th style="">Quantity</th>
                                                    <th style="">Amount</th>
                                                    <th style="">Action</th>


                                                </tr>
                                            </thead>


                                            <tbody>
                                                 @for ($i=0; $i < 2; $i++)
                                        <tr id="row_{{ $i }}">

                                            <td id="aod_t{{ $i }}">


                                                <select name="aod_td{{ $i }}"
                                                    class="form-control items selectize" id="aod_td{{ $i }}"
                                                    style="width:100%;height:30px;"
                                                    onchange="getDataTblOtherDetails('{{ $i }}');">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>


                                                </select>


                                            </td>
                                            <td id="item_td{{ $i }}">

                                                <input type="text" class="form-control"
                                                    name="item_se{{ $i }}" id="item_se{{ $i }}"
                                                    style="width:100%;height:30px;text-align: center;">
                                            </td>

                                            <td id="qty_td{{ $i }}">
                                                <select name="qty_se{{ $i }}" class="form-control  "
                                                    id="qty_se{{ $i }}" style="width:100%;height:30px;"
                                                    onchange="">
                                                    <option></option>
                                                </select>
                                            </td>

                                            <td id="amount_td{{ $i }}">
                                                <input type="text" class="form-control"
                                                    name="amount_se{{ $i }}"
                                                    id="amount_se{{ $i }}" style="text-align: center;">
                                            </td>
                                            <td class="text-blue text-center">
                                                <button class="btn btn-danger btn-sm" type="button"  onclick="deleteTableRow('{{ $i }}')">Delete
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
                                        <textarea class="form-control" id="comment" rows="4" placeholder="Enter your comments here..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Page-level Buttons -->
                            <div class="mt-3 d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-success">Save & Close</button>
                                <button type="button" class="btn btn-secondary" onclick="window.close();">Close</button>
                            </div>

                        </div>
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
}

// Add new row dynamically
function addRow() {
    const tableBody = document.querySelector('#my_data_table_3inv tbody');
    const index = rowCount;

    const row = document.createElement('tr');
    row.id = `row_${index}`;
    row.innerHTML = `
        <td id="aod_t${index}">
            <select name="aod_td${index}" class="form-control items selectize" id="aod_td${index}" style="width:100%;height:35px;" onchange="getDataTblOtherDetails(${index});">
                <option value="">Select No</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </td>
        <td id="item_td${index}">
            <input type="text" class="form-control" name="item_se${index}" id="item_se${index}" style="width:100%;height:30px;text-align:center;">
        </td>
        <td id="qty_td${index}">
            <select name="qty_se${index}" class="form-control" id="qty_se${index}" style="width:100%;height:35px;"></select>
        </td>
        <td id="amount_td${index}">
            <input type="text" class="form-control" name="amount_se${index}" id="amount_se${index}" style="text-align:center;">
        </td>
        <td class="text-blue text-center">
    <button class="btn btn-danger btn-sm" type="button" onclick="deleteTableRow(${index})">
    Delete
</button>

</td>

    `;
    tableBody.appendChild(row);

    // Populate quantity dropdown
    populateQtyDropdown(index);

    rowCount++;
}

// Delete row
function deleteTableRow(index) {
    const row = document.getElementById(`row_${index}`);
    if (row) row.remove();
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
    background-color: #dc3545; /* red */
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

