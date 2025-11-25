@extends('layouts.app')

@section('title', 'Userlevel')

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
                            <div class="card-body">

                                <div class="col-md-6 d-flex align-items-center">

                                    <button class="btn btn-primary" ">
                                                                                <i class=" bi bi-plus-lg"></i> All Outwards
                                                            </button>
                                                        </div><br>

                                                        <div class="row ">

                                                            <!-- Add userlevel Button -->
                                                            <div class="col-sm-3">
                                                                <div class="form-group-sm">
                                                                    <label for="phone">Outward NO&nbsp;<span style="color:red;">*</span></label>
                                                                    <input type="text" readonly placeholder="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group-sm">
                                                                    <label for="center" class=" ">Center&nbsp;<span style="color:red;">*</span>
                                                                    </label>
                                                                    <select name="center" id="center" required="" class="form-control selectize"
                                                                        onchange="">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-3">
                                                                <div class="form-group-sm">
                                                                    <label class="">Vehicle No&nbsp;<span style="color:red;">*</span></label>
                                                                    <select name="vehicle_no" id="vehicle_no" required=""
                                                                        class="form-control selectize" onchange="">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group-sm  col-sm-3">
                                                                <label for="_Expectdate" class=""> Driver&nbsp;<span style="color:red;">*</span>
                                                                </label>
                                                                <!--<div class="col-sm-8 ">-->
                                                                <div class=" input-group">
                                                                    <input type="date" class="form-control date-picker"
                                                                        value="<?php echo date('Y-m-d'); ?>" data-date-format="yyyy-mm-dd"
                                                                        name="date" id="date" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <div class="form-group-sm">
                                                                    <label for="center" class=" ">Helper&nbsp;<span style="color:red;">*</span>
                                                                    </label>
                                                                    <select name="center" id="center" required="" class="form-control selectize"
                                                                        onchange="">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" value="" class="form-control" name="rowCount1" id="rowCount1">

                                                            <div class="col-sm-3">
                                                                <div class="form-group-sm">
                                                                    <label class="">Vehicle Type&nbsp;<span style="color:red;">*</span></label>
                                                                    <select name="vehicle_no" id="vehicle_no" required=""
                                                                        class="form-control selectize" onchange="">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                        </div><br>
                                                        <div class="table-responsive">
                                                            <table id="my_data_table_3inv"
                                                                name="my_data_table_3invoice"
                                                                class="table table-responsive"
                                                                style="margin-bottom: 10px; width: 100%;">

                                            <thead style="background-color: white;" class="form-group-sm">
                                                <tr>
                                                    <!-- <th style="width: 200px !important;">Item Code</th> -->
                                                    <th style="">AOD No</th>
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
                                                <button class="btn-grid-delete" type="button"
                                                    onclick="deleteTableRow('{{ $i }}')"><i
                                                        class="fa fa-trash fa-lg"></i></button>
                                            </td>

                                        </tr>
                                        @endfor
                                        </tbody>
                                        </table>
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
    function getDataTblOtherDetails(no) {
        // ensure `no` is a number (Blade passed it as a string)
        no = parseInt(no, 10);

        // get selected value (if the <select> has id="aod_td{no}")
        var cmbSelectVal = $('#aod_td' + no).val();

        // correct jQuery selector with $
        var tableSize = $('#my_data_table_3inv tbody tr').length;

        console.log('tableSize =', tableSize, 'no =', no, 'selected =', cmbSelectVal);

        // If current row is the last row, add a new line
        if (no === tableSize - 1) {
            addNewLine();
        }
    }

    function addNewLine() {
        console.log('hit')
        var item_row = $('#rowCount1').val();

        console.log($('#rowCount1').val());
        item_row++;
        countRows();
        $('#tblRowCounting1').html(item_row);
        $('#tblRowCounting2').html(item_row);

        var table = document.getElementById("my_data_table_3inv");
        var row = table.insertRow(item_row);
        $("#my_data_table_3inv tbody").append(row);


        var cell1 = row.insertCell(0);
        cell1.id = 'aod_td' + (item_row - 1);
        var cell2 = row.insertCell(1);
        cell2.id = 'item_td' + (item_row - 1);
        var cell3 = row.insertCell(2);
        cell3.id = 'qty_td' + (item_row - 1);
        var cell4 = row.insertCell(3);
        cell4.id = 'amount_td' + (item_row - 1);
        var cell5 = row.insertCell(4);

        cell1.innerHTML =
            `<select name="aod_td${item_row - 1}" class="form-control items selectize" id="aod_td${item_row - 1}" style="width:100%;height:30px;" onchange="mesurepop_up(${item_row - 1});embroider_popup(${item_row - 1});getDataTblOtherDetails(${item_row - 1});">
             <option></option>

        </select>
        `;


        cell2.innerHTML = `<select name="item_se${item_row - 1}" class="form-control  selectize " id="item_se${item_row - 1}" style="width:100%;height:30px;" onchange="getprice(${item_row - 1});">
                    <option></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    </select>`;
        cell3.innerHTML = `<select name="qty_se${item_row - 1}" class="form-control  selectize" id="qty_se${item_row - 1}" style="width:100%;height:30px;" >
                                <option></option>

                            </select>`;

        cell4.innerHTML =
            `<input type="text"  class="form-control" name="amount_se${item_row - 1}" id="amount_se${item_row - 1}" style="width:100%;height:30px;text-align: center;" >`;



        cell5.innerHTML =
            "<td class='text-blue text-center'> <button class='btn-grid-delete' type='button'onclick='deleteTableRow(" +
            (item_row - 1) + ")'; ><i class='bi bi-trash fa-lg text-blue text-right'> </i></button></td>";

        $('.selectize').select2();

    }

     function countRows() {

        var descElements = document.querySelectorAll('[id^="aod_td"]');
        var count = descElements.length;
        document.getElementById('rowCount1').value = count;
        console.log("Updated count of aod_td elements: " + count);
    }

    function deleteTableRow(num) {
        // Clear input fields

        document.getElementById('aod_td' + num).selectedIndex = 0; // Clear textarea
        document.getElementById('item_se' + num).selectedIndex = 0; // Reset select to default option
        document.getElementById('qty_se' + num).selectedIndex = 0;// Clear input
        document.getElementById('amount_se' + num).value = ''; // Clear input


        // Recalculate footer details, totals, etc.
        countRows()


        // calculateNbt();
        // footerDiscount();
        $(".selectize").select2(); // Refresh select2 dropdowns
        refreshAllSelect();
    }
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
