@extends('layouts.app')

@section('title', 'Userlevel')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Outward Module Type 2</h3>
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
                        <div class="card-body">

                            <div class="col-md-6 d-flex align-items-center">
                                <button class="btn btn-primary">
                                    <i class="bi bi-plus-lg"></i> All Outwards
                                </button>
                            </div>

                            <br>

                            <div class="row">

                                <!-- Outward No -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label>Outward NO <span class="text-danger">*</span></label>
                                        <input type="text" readonly class="form-control">
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
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="type">Type<span style="color:red;">*</span></label>
                                        <input type="type" id="type" name="type" class="form-control">
                                    </div>
                                </div>


                                <!-- Vehicle No -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label>Vehicle No <span class="text-danger">*</span></label>
                                        <select name="vehicle_no" id="vehicle_no" class="form-control selectize" required>
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
                                            <input type="date" name="date" id="date"
                                                value="{{ date('Y-m-d') }}"
                                                class="form-control date-picker">
                                        </div>
                                    </div>
                                </div>

                                <!-- Driver -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label>Driver <span class="text-danger">*</span></label>
                                        <select name="driver" id="driver" class="form-control selectize" required>
                                            <option value="">Select Driver:</option>
                                            @foreach ($drivers as $d)
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
                                            @foreach ($helpers as $h)
                                                <option value="{{ $h->id }}">{{ $h->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" id="rowCount1" name="rowCount1" class="form-control">

                                <!-- Vehicle Type -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label>Vehicle Type <span class="text-danger">*</span></label>
                                        <select class="form-control selectize" required>
                                            <option value="">Select Vehicle Type:</option>
                                            @foreach ($vehicles as $v)
                                                <option value="{{ $v->id }}">{{ $v->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                 <!-- Time In -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="time_in">Time In&nbsp;<span style="color:red;">*</span></label>
                                        <input type="time" id="time_in" name="time_in" class="form-control">
                                    </div>
                                </div>

                                 <!-- Time Out -->
                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="time_in">Time Out&nbsp;<span style="color:red;">*</span></label>
                                        <input type="time" id="time_out" name="time_out" class="form-control">
                                    </div>
                                </div>

                                <!-- Meter R/In -->

                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="meter_in">Meter R/In&nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" id="meter_in" name="meter_in" class="form-control" min="0">
                                    </div>
                                </div>

                                 <!-- Meter R/out -->

                                <div class="col-sm-3">
                                    <div class="form-group-sm">
                                        <label for="meter_in">Meter R/Out&nbsp;<span style="color:red;">*</span></label>
                                        <input type="number" id="meter_out" name="meter_out" class="form-control" min="0">
                                    </div>
                                </div>



                            </div>


                            <!-- Comment Section -->
                            <div class="card shadow-sm border-0 mt-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="comment"><strong>Comments</strong></label>
                                        <textarea id="comment" rows="4" class="form-control" placeholder="Enter your comments here..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Page Buttons -->
                            <div class="mt-3 d-flex justify-content-end gap-2">
                                <button class="btn btn-primary">Save</button>
                                <button class="btn btn-success">Save & Close</button>
                                <button class="btn btn-secondary" onclick="window.close();">Close</button>
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

let rowCount = 2;

function handleAODChange(index) {
    let aodValue = document.getElementById('aod_' + index).value;

    if (aodValue !== '') {
        document.getElementById('action_' + index).innerHTML = `
            <button class="btn btn-danger btn-sm" style="border-radius:20px; padding:3px 10px;" onclick="deleteRow(${index})">
                Delete
            </button>
        `;
    } else {
        document.getElementById('action_' + index).innerHTML = '';
    }

    if (index === rowCount - 1 && aodValue !== '') {
        addRow();
    }
}

function addRow() {
    let table = document.querySelector('#outwardTable tbody');
    let index = rowCount;

    let row = `
        <tr id="row_${index}">
            <td>
                <select id="aod_${index}" class="form-control selectize" onchange="handleAODChange(${index})">
                    <option value="">Select AOD</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </td>
            <td><input type="text" class="form-control" id="item_${index}"></td>
            <td>
                <select id="qty_${index}" class="form-control selectize">
                    <option value="">Select Qty</option>
                </select>
            </td>
            <td><input type="text" class="form-control" id="amount_${index}"></td>
            <td class="text-center" id="action_${index}"></td>
        </tr>
    `;

    table.insertAdjacentHTML('beforeend', row);
    rowCount++;
}

function deleteRow(index) {
    document.getElementById('row_' + index).remove();
}

</script>
@endsection
