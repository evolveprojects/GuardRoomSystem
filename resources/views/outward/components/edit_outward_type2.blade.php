<!-- Edit Outward Type 2 Modal -->
<!-- Edit Vehicle Button -->
<a href="{{ route('outward.type2.edit', $data->id) }}"
   class="btn btn-success btn-sm w-100 text-white">
    Edit
</a>


<div class="modal fade" id="edit-outward-modal-{{ $outward->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl" style="max-width: 95%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Outward - {{ $outward->outward_no }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('outward.type2.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $outward->id }}">
<input type="hidden" id="edit_rowCount1_{{ $outward->id }}" name="rowCount1" 
       value="{{ isset($outward->t2Items) ? $outward->t2Items->count() : 0 }}">
                <div class="modal-body">
                    <div class="row">
                        <!-- Outward No -->
                        <div class="col-sm-3 mb-3">
                            <label>Outward NO <span class="text-danger">*</span></label>
                            <input type="text" name="outward_no" value="{{ $outward->outward_no }}" 
                                   class="form-control" readonly style="height:30px;">
                        </div>

                        <!-- Center -->
                        <div class="col-sm-3 mb-3">
                            <label>Center <span class="text-danger">*</span></label>
                            <select name="center_id" class="form-control edit-selectize" required>
                                <option value="">Select Center</option>
                                @foreach($centers as $c)
                                    <option value="{{ $c->id }}" {{ $outward->center_id == $c->id ? 'selected' : '' }}>
                                        {{ $c->center_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Type -->
                        <div class="col-sm-3 mb-3">
                            <label>Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-control edit-selectize edit-type-select" 
                                    data-outward-id="{{ $outward->id }}" required>
                                <option value="">Select Type</option>
                                <option value="Passenger" {{ $outward->type == 'Passenger' ? 'selected' : '' }}>Passenger</option>
                                <option value="Company" {{ $outward->type == 'Company' ? 'selected' : '' }}>Company</option>
                            </select>
                        </div>

                        <!-- Vehicle No -->
                        <div class="col-sm-3 mb-3">
                            <label>Vehicle No <span class="text-danger">*</span></label>
                            <select name="vehicle_id" class="form-control edit-selectize" required>
                                <option value="">Select Vehicle</option>
                                @foreach($vehicles as $v)
                                    <option value="{{ $v->id }}" {{ $outward->vehicle_id == $v->id ? 'selected' : '' }}>
                                        {{ $v->vehicle_no }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="col-sm-3 mb-3">
                            <label>Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" value="{{ $outward->date }}" 
                                   class="form-control" style="height:30px;" required>
                        </div>

                        <!-- Driver -->
                        <div class="col-sm-3 mb-3">
                            <label>Driver <span class="text-danger">*</span></label>
                            <select name="driver_id" class="form-control edit-selectize" required>
                                <option value="">Select Driver</option>
                                @foreach($drivers as $d)
                                    <option value="{{ $d->id }}" {{ $outward->driver_id == $d->id ? 'selected' : '' }}>
                                        {{ $d->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Helper -->
                        <div class="col-sm-3 mb-3">
                            <label>Helper <span class="text-danger">*</span></label>
                            <select name="helper_id" class="form-control edit-selectize" required>
                                <option value="">Select Helper</option>
                                @foreach($helpers as $h)
                                    <option value="{{ $h->id }}" {{ $outward->helper_id == $h->id ? 'selected' : '' }}>
                                        {{ $h->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Vehicle Type -->
                        <div class="col-sm-3 mb-3">
                            <label>Vehicle Type <span class="text-danger">*</span></label>
                            <select name="vehicle_type" class="form-control edit-selectize" required>
                                <option value="">Select Vehicle Type</option>
                                <option value="Car" {{ $outward->vehicle_type == 'Car' ? 'selected' : '' }}>Car</option>
                                <option value="Van" {{ $outward->vehicle_type == 'Van' ? 'selected' : '' }}>Van</option>
                                <option value="Bus" {{ $outward->vehicle_type == 'Bus' ? 'selected' : '' }}>Bus</option>
                                <option value="Lorry" {{ $outward->vehicle_type == 'Lorry' ? 'selected' : '' }}>Lorry</option>
                                <option value="Bike" {{ $outward->vehicle_type == 'Bike' ? 'selected' : '' }}>Bike</option>
                            </select>
                        </div>

                        <!-- Time Out -->
                        <div class="col-sm-3 mb-3">
                            <label>Time Out <span class="text-danger">*</span></label>
                            <input type="time" name="time_out" 
       value="{{ $outward->time_out ? \Carbon\Carbon::parse($outward->time_out)->format('H:i') : '' }}" 
       class="form-control" style="height:30px;" required>

                        </div>

                        <!-- Time In (Now visible in edit) -->
                        <div class="col-sm-3 mb-3">
                            <label>Time In</label>
                            <input type="time" name="time_in" value="{{ $outward->time_in }}" 
                                   class="form-control" style="height:30px;">
                        </div>

                        <!-- Meter R/Out -->
                        <div class="col-sm-3 mb-3">
                            <label>Meter R/Out <span class="text-danger">*</span></label>
                            <input type="number" name="meter_out" value="{{ $outward->meter_out }}" 
                                   class="form-control" min="0" style="height:30px;" required>
                        </div>

                        <!-- Meter R/In (Now visible in edit) -->
                        <div class="col-sm-3 mb-3">
                            <label>Meter R/In</label>
                            <input type="number" name="meter_in" value="{{ $outward->meter_in }}" 
                                   class="form-control" min="0" style="height:30px;">
                        </div>
                    </div>

                    <!-- Comment Section -->
                    <div id="edit_comment_section_{{ $outward->id }}" 
                         class="card shadow-sm border-0 mt-4" 
                         style="display: {{ $outward->type == 'Passenger' ? 'block' : 'none' }};">
                        <div class="card-body">
                            <div class="form-group">
                                <label><strong>Comments</strong></label>
                                <textarea name="comments" rows="4" class="form-control" 
                                          placeholder="Enter your comments here...">{{ $outward->comments }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Company Table Section -->
                    <div id="edit_company_table_section_{{ $outward->id }}" 
                         class="card shadow-sm border-0 mt-4" 
                         style="display: {{ $outward->type == 'Company' ? 'block' : 'none' }};">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Company Items</h5>
                                <button type="button" class="btn btn-success btn-sm" 
                                        onclick="addEditTableRow({{ $outward->id }})">
                                    <i class="bi bi-plus-circle"></i> Add Row
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table id="edit_my_data_table_{{ $outward->id }}" class="table table-responsive" 
                                       style="margin-bottom: 10px; width: 100%;">
                                    <thead style="background-color: white;" class="form-group-sm">
                                        <tr>
                                            <th>No</th>
                                            <th>Items</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    @if(isset($outward->t2Items) && $outward->t2Items->count() > 0)
        @foreach($outward->t2Items as $index => $item)
            <tr id="edit_row_{{ $outward->id }}_{{ $index }}" class="edit-data-row">
                <td>
                    <input type="number" name="aod_td{{ $index }}" 
                           value="{{ $item->no }}" 
                           class="form-control" 
                           style="width:100%;height:30px;text-align:center;" 
                           min="1" step="1"
                           oninput="checkAndAddEditRow({{ $outward->id }}, {{ $index }})">
                </td>
                <td>
                    <input type="text" name="item_se{{ $index }}" 
                           value="{{ $item->item }}" 
                           class="form-control" 
                           style="width:100%;height:30px;text-align:center;"
                           oninput="checkAndAddEditRow({{ $outward->id }}, {{ $index }})">
                </td>
                <td>
                    <input type="number" name="qty_se{{ $index }}" 
                           value="{{ $item->quantity }}" 
                           class="form-control" 
                           style="width:100%;height:30px;text-align:center;" 
                           min="0" step="1"
                           oninput="checkAndAddEditRow({{ $outward->id }}, {{ $index }})">
                </td>
                <td>
                    <input type="text" name="amount_se{{ $index }}" 
                           value="{{ $item->amount }}" 
                           class="form-control" 
                           style="text-align:center;height:30px;"
                           oninput="checkAndAddEditRow({{ $outward->id }}, {{ $index }})">
                </td>
                <td class="text-blue text-center">
                    <button class="btn btn-danger btn-sm edit-delete-btn" 
                            type="button" 
                            onclick="deleteEditTableRow({{ $outward->id }}, {{ $index }})"
                            style="{{ $outward->t2Items->count() <= 1 ? 'display:none;' : '' }}">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
    @else
        <tr id="edit_row_{{ $outward->id }}_0" class="edit-data-row">
            <td>
                <input type="number" name="aod_td0" class="form-control" 
                       style="width:100%;height:30px;text-align:center;" 
                       min="1" step="1"
                       oninput="checkAndAddEditRow({{ $outward->id }}, 0)">
            </td>
            <td>
                <input type="text" name="item_se0" class="form-control" 
                       style="width:100%;height:30px;text-align:center;"
                       oninput="checkAndAddEditRow({{ $outward->id }}, 0)">
            </td>
            <td>
                <input type="number" name="qty_se0" class="form-control" 
                       style="width:100%;height:30px;text-align:center;" 
                       min="0" step="1"
                       oninput="checkAndAddEditRow({{ $outward->id }}, 0)">
            </td>
            <td>
                <input type="text" name="amount_se0" class="form-control" 
                       style="text-align:center;height:30px;"
                       oninput="checkAndAddEditRow({{ $outward->id }}, 0)">
            </td>
            <td class="text-blue text-center">
                <button class="btn btn-danger btn-sm edit-delete-btn" 
                        type="button" 
                        onclick="deleteEditTableRow({{ $outward->id }}, 0)"
                        style="display:none;">
                    Delete
                </button>
            </td>
        </tr>
    @endif
</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Update
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Global row counter for edit modals
var editGlobalRowIndex_{{ $outward->id }} = {{ $outward->t2Items->count() > 0 ? $outward->t2Items->count() : 1 }};

// Initialize when modal is shown
$('#edit-outward-modal-{{ $outward->id }}').on('shown.bs.modal', function() {
    // Initialize Select2
    $(this).find('.edit-selectize').select2({
        dropdownParent: $(this),
        width: '100%'
    });
    
    // Type toggle functionality
    $(this).find('.edit-type-select').on('change', function() {
        var outwardId = $(this).data('outward-id');
        var value = $(this).val();
        
        if (value === 'Company') {
            $('#edit_comment_section_' + outwardId).hide();
            $('#edit_company_table_section_' + outwardId).show();
            updateEditRowCount(outwardId);
        } else {
            $('#edit_comment_section_' + outwardId).show();
            $('#edit_company_table_section_' + outwardId).hide();
            $('#edit_rowCount1_' + outwardId).val('0');
        }
    });
    
    // Initial row count
    updateEditRowCount({{ $outward->id }});
    updateEditDeleteButtons({{ $outward->id }});
});

// Destroy Select2 when modal is hidden
$('#edit-outward-modal-{{ $outward->id }}').on('hidden.bs.modal', function() {
    $(this).find('.edit-selectize').select2('destroy');
});

// Check and add row for edit table
function checkAndAddEditRow(outwardId, currentIndex) {
    var $tbody = $('#edit_my_data_table_' + outwardId + ' tbody');
    var $allRows = $tbody.find('tr.edit-data-row');
    var lastRowIndex = $allRows.length - 1;
    
    // Get the actual row index from the row ID
    var $currentRow = $('#edit_row_' + outwardId + '_' + currentIndex);
    var currentRowPosition = $currentRow.index();
    
    // Check if this is the last row
    if (currentRowPosition === lastRowIndex) {
        var no = $('[name="aod_td' + currentIndex + '"]').val();
        var item = $('[name="item_se' + currentIndex + '"]').val();
        var qty = $('[name="qty_se' + currentIndex + '"]').val();
        var amount = $('[name="amount_se' + currentIndex + '"]').val();
        
        if (no || item || qty || amount) {
            addEditTableRow(outwardId);
        }
    }
    
    updateEditRowCount(outwardId);
    updateEditDeleteButtons(outwardId);
}

// Add new row to edit table
function addEditTableRow(outwardId) {
    var newRowIndex = editGlobalRowIndex_{{ $outward->id }}++;
    
    var newRow = `
        <tr id="edit_row_${outwardId}_${newRowIndex}" class="edit-data-row">
            <td>
                <input type="number" name="aod_td${newRowIndex}" class="form-control" 
                       style="width:100%;height:30px;text-align:center;" min="1" step="1"
                       oninput="checkAndAddEditRow(${outwardId}, ${newRowIndex})">
            </td>
            <td>
                <input type="text" name="item_se${newRowIndex}" class="form-control" 
                       style="width:100%;height:30px;text-align:center;"
                       oninput="checkAndAddEditRow(${outwardId}, ${newRowIndex})">
            </td>
            <td>
                <input type="number" name="qty_se${newRowIndex}" class="form-control" 
                       style="width:100%;height:30px;text-align:center;" min="0" step="1"
                       oninput="checkAndAddEditRow(${outwardId}, ${newRowIndex})">
            </td>
            <td>
                <input type="text" name="amount_se${newRowIndex}" class="form-control" 
                       style="text-align:center;height:30px;"
                       oninput="checkAndAddEditRow(${outwardId}, ${newRowIndex})">
            </td>
            <td class="text-blue text-center">
                <button class="btn btn-danger btn-sm edit-delete-btn" type="button" 
                        onclick="deleteEditTableRow(${outwardId}, ${newRowIndex})">
                    Delete
                </button>
            </td>
        </tr>
    `;
    
    $('#edit_my_data_table_' + outwardId + ' tbody').append(newRow);
    updateEditRowCount(outwardId);
    updateEditDeleteButtons(outwardId);
}

// Delete edit table row
function deleteEditTableRow(outwardId, rowIndex) {
    var $tbody = $('#edit_my_data_table_' + outwardId + ' tbody');
    var rowCount = $tbody.find('tr.edit-data-row').length;
    
    if (rowCount <= 1) {
        alert('Cannot delete the last row!');
        return;
    }
    
    $('#edit_row_' + outwardId + '_' + rowIndex).remove();
    updateEditRowCount(outwardId);
    updateEditDeleteButtons(outwardId);
}

// Update delete button visibility for edit table
function updateEditDeleteButtons(outwardId) {
    var $tbody = $('#edit_my_data_table_' + outwardId + ' tbody');
    var $rows = $tbody.find('tr.edit-data-row');
    var rowCount = $rows.length;
    
    var $modal = $('#edit-outward-modal-' + outwardId);
    
    if (rowCount <= 1) {
        $modal.find('.edit-delete-btn').hide();
    } else {
        $modal.find('.edit-delete-btn').show();
    }
}

// Update row count for edit table
function updateEditRowCount(outwardId) {
    var rowCount = $('#edit_my_data_table_' + outwardId + ' tbody tr.edit-data-row').length;
    $('#edit_rowCount1_' + outwardId).val(rowCount);
    console.log('Edit row count updated for outward ' + outwardId + ':', rowCount);
}
</script>